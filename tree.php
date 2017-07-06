<?
class node
{
        public $left;
        public $right;
        public $value;
}

$input = array(1,2,3,4,5,6,7,8,9);

$queue = array();

$i = 0;

$level = 2;
$max = count($input);

$current = new node();
$current->value = $input[$i++];
$current->left = null;
$current->right = null;

array_unshift($queue,  $current);

echo $current->value." ";

while ( $i < $max )
{
        $j = pow(2,$level-1);

        // create nodes until 2^(level-1) and
        while( $j > 0  && $i < $max )
        {

                $parent = array_pop($queue);

                // create a left node
                $newLeft = new node();
                $newLeft->value = $input[$i++];
                $newLeft->left = null;
                $newLeft->right = null;

                $parent->left =  $newLeft;
                array_unshift($queue, $newLeft);

                $j--;

                if($i >= $max || $j <= 0)
                {
                   break;
                }

                // create right node
                $newRight = new node();
                $newRight->value = $input[$i++];
                $newRight->left = null;
                $newRight->right = null;

                $parent->right = $newRight;
                array_unshift($queue, $newRight);

                $j--;
                echo print_r($parent,1);

        }

        $level++;
        echo "level :".$level;
        //echo print_r($queue,1);
}
?>