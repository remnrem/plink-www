<?
/*****************************************************************************
 * $Title: XML parsing example: Collect statistics about a XML document $    *
 * $Description:                                                             *
 * This example uses PHP's expat parser to collect statistical information   * 
 * (like number of distinct elements, children and parents of elements)      *
 * about a XML document.                                                     *
 * Call it with the XML file to process as argument:                         *
 * ./xmlstats_PHP4.php3 test.xml                                             *
 *                                                                           *
 * $Requires: Expat                                                          *
 *            PHP 4.0 built as CGI binary $                                  *
 *                                                                           *
 *****************************************************************************/

// The first argument is the file to process
$file = $argv[1];

// Initialize variables
$elements = $stack = array();
$total_elements = $total_chars = 0;

// The base class for an element
class element
{
    var $count = 0;
    var $chars = 0;
    var $parents = array();
    var $childs = array();
}

// Utility function to parse a XML document from a file
function xml_parse_from_file($parser, $file)
{
    if(!file_exists($file))
    {
        die("Can't find file \"$file\".");
    }
    
    if(!($fp = @fopen($file, "r"))) 
    {
        die("Can't open file \"$file\".");
    }
    
    while($data = fread($fp, 4096))
    {
        if(!xml_parse($parser, $data, feof($fp)))
        {
            return(false);
        }
    }
    
    fclose($fp);
    
    return(true);
}

// Utility function to print a message in a box
function print_box($title, $value)
{
    printf("\n+%'-60s+\n", "");
    printf("|%20s", "$title:");
    printf("%14s", $value);
    printf("%26s|\n", "");
    printf("+%'-60s+\n", "");    
}

// Utility function to print a line
function print_line($title, $value)
{
    printf("%20s", "$title:");
    printf("%15s\n", $value);
}

// Sort function for usasort()
function my_sort($a, $b)
{
    return(is_object($a) && is_object($b) ? $b->count - $a->count: 0);
}

function start_element($parser, $name, $attrs)
{
    global $elements, $stack;
    
    // Does this element already exist in the global $elements array?
    if(!isset($elements[$name]))
    {
        // No - add a new instance of class element
        $element = new element;
        $elements[$name] = $element;
    }

    // Increase this elements count
    $elements[$name]->count++;
        
    // Is there a parent element?
    if(isset($stack[count($stack)-1]))
    {
        // Yes - set $last_element to the parent
        $last_element = $stack[count($stack)-1];
    
        // If there is no entry for the parent element in the current
        // element's parents array, initialize it to 0
        if(!isset($elements[$name]->parents[$last_element]))
        {
            $elements[$name]->parents[$last_element] = 0;
        }
        
        // Increase the count for this element's parent
        $elements[$name]->parents[$last_element]++;
    
        // If there is no entry for this element in the parent's
        // elements' child array, initialize it to 0
        if(!isset($elements[$last_element]->childs[$name]))
        {
            $elements[$last_element]->childs[$name] = 0;
        }

        // Increase the count for this element parent in the parent's
        // childs array
        $elements[$last_element]->childs[$name]++;
    }
    
    // Add current element to the stack
    array_push($stack, $name);    
}

function stop_element($parser, $name)
{
    global $stack;

    // Remove last element from the stack
    array_pop($stack);
}

function char_data($parser, $data)
{
    global $elements, $stack, $depth;
    
    // Increase character count for the current element
    $elements[$stack[count($stack)-1]]->chars += strlen(trim($data));
}

// Create Expat parser
$parser = xml_parser_create();

// Set handler functions
xml_set_element_handler($parser, "start_element", "stop_element");
xml_set_character_data_handler($parser, "char_data");
xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);

// Parse the file
$ret = xml_parse_from_file($parser, $file);
if(!$ret)
{
    die(sprintf("XML error: %s at line %d",
                    xml_error_string(xml_get_error_code($parser)),
                    xml_get_current_line_number($parser)));
}

// Free parser
xml_parser_free($parser);

// Free helper elements
unset($elements["current_element"]);
unset($elements["last_element"]);

// Sort $elements array by element count
uasort($elements, "my_sort");

// Loop through all elements collected in $elements
while(list($name, $element) = each($elements))
{
    print_box("Element name", $name);
    
    print_line("Element count", $element->count);
    print_line("Character count", $element->chars);
    
    printf("\n%20s\n", "* Parent elements");
    
    // Loop through the parents of this element, output them
    while(list($key, $value) = each($element->parents))
    {
        print_line($key, $value);
    }
    if(count($element->parents) == 0)
    {
        printf("%35s\n", "[root element]");
    }

    // Loop through the childs of this element, output them    
    printf("\n%20s\n", "* Child elements");
    while(list($key, $value) = each($element->childs))
    {
        print_line($key, $value);
    }    
    if(count($element->childs) == 0)
    {
        printf("%35s\n", "[no childs]");
    }    
    
    $total_elements += $element->count;
    $total_chars += $element->chars;
}

// Final summary
print_box("Total elements", $total_elements);
print_box("Total characters", $total_chars);
?>

