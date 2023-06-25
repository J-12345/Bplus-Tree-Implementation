<?php
error_reporting(E_ERROR | E_PARSE);
class Node {
    public $IS_LEAF;
    public $key;
    public $size;
    public $ptr;

    public function __construct() {
        $this->key = array();
        $this->ptr = array();
    }
}

class BPTree {
    private $root;
    private $MAX;

    public function __construct() {
        $this->root = NULL;
        $this->MAX = 3;
    }

    function search($x) {
        $arr=array(array());
        $this->display($this->getRoot(),0,$arr);
        foreach ($arr as $level => $keys)
        {
            foreach ($keys as $key)
            {
                if($x===$key)
                {
                return $level;
                }
            }
        }
        return -1;
    }
     

    public function insert($x)
    {
        if ($this->root === null) {
            $this->root = new Node();
            $this->root->key[0] = $x;
            $this->root->IS_LEAF = true;
            $this->root->size = 1;
        } else {
            $cursor = $this->root;
            $parent = null;
            while ($cursor->IS_LEAF == false) {
                $parent = $cursor;
                for ($i = 0; $i < $cursor->size; $i++) {
                    if ($x < $cursor->key[$i]) {
                        $cursor = $cursor->ptr[$i];
                        break;
                    }
                    if ($i == $cursor->size - 1) {
                        $cursor = $cursor->ptr[$i + 1];
                        break;
                    }
                }
            }
            if ($cursor->size < $this->MAX) {
                $i = 0;
                while ($x > $cursor->key[$i] && $i < $cursor->size) {
                    $i++;
                }
                for ($j = $cursor->size; $j > $i; $j--) {
                    $cursor->key[$j] = $cursor->key[$j - 1];
                }
                $cursor->key[$i] = $x;
                $cursor->size++;
                $cursor->ptr[$cursor->size] = $cursor->ptr[$cursor->size - 1];
                $cursor->ptr[$cursor->size - 1] = null;
            } else {
                $newLeaf = new Node();
                $virtualNode = [];
                for ($i = 0; $i < $this->MAX; $i++) {
                    $virtualNode[$i] = $cursor->key[$i];
                }
                $i = 0;
                while ($x > $virtualNode[$i] && $i < $this->MAX) {
                    $i++;
                }
                for ($j = $this->MAX + 1; $j > $i; $j--) {
                    $virtualNode[$j] = $virtualNode[$j - 1];
                }
                $virtualNode[$i] = $x;
                $newLeaf->IS_LEAF = true;
                $cursor->size = ($this->MAX + 1) / 2;
                $newLeaf->size = $this->MAX + 1 - ($this->MAX + 1) / 2;
                $cursor->ptr[$cursor->size] = $newLeaf;
                $newLeaf->ptr[$newLeaf->size] = $cursor->ptr[$this->MAX];
                $cursor->ptr[$this->MAX] = null;
                for ($i = 0; $i < $cursor->size; $i++) {
                    $cursor->key[$i] = $virtualNode[$i];
                }
                for ($i = 0, $j = $cursor->size; $i < $newLeaf->size; $i++, $j++) {
                    $newLeaf->key[$i] = $virtualNode[$j];
                }
                if ($cursor === $this->root) {
                    $newRoot = new Node();
                    $newRoot->key[0] = $newLeaf->key[0];
                    $newRoot->ptr[0] = $cursor;
                    $newRoot->ptr[1] = $newLeaf;
                    $newRoot->IS_LEAF = false;
                    $newRoot->size = 1;
                    $this->root = $newRoot;
                } else {
                    $this->insertInternal($newLeaf->key[0], $parent, $newLeaf);
                }
            }
        }
    }

    private function insertInternal($x, $cursor, $child) {
        if ($cursor->size < $this->MAX) {
            $i = 0;
            while ($x > $cursor->key[$i] && $i < $cursor->size) {
                $i++;
            }
            for ($j = $cursor->size; $j > $i; $j--) {
                $cursor->key[$j] = $cursor->key[$j - 1];
            }
            for ($j = $cursor->size + 1; $j > $i + 1; $j--) {
                $cursor->ptr[$j] = $cursor->ptr[$j - 1];
            }
            $cursor->key[$i] = $x;
            $cursor->size++;
            $cursor->ptr[$i + 1] = $child;
        } else {
            $newInternal = new Node();
            $virtualKey = array();
            $virtualPtr = array();
            for ($i = 0; $i < $this->MAX; $i++) {
                $virtualKey[$i] = $cursor->key[$i];
            }
            for ($i = 0; $i < $this->MAX + 1; $i++) {
                $virtualPtr[$i] = $cursor->ptr[$i];
            }
            $i = 0;
            while ($x > $virtualKey[$i] && $i < $this->MAX) {
                $i++;
            }
            for ($j = $this->MAX + 1; $j > $i; $j--) {
                $virtualKey[$j] = $virtualKey[$j - 1];
            }
            $virtualKey[$i] = $x;
            for ($j = $this->MAX + 2; $j > $i + 1; $j--) {
                $virtualPtr[$j] = $virtualPtr[$j - 1];
            }
            $virtualPtr[$i + 1] = $child;
            $newInternal->IS_LEAF = false;
            $cursor->size = ($this->MAX + 1) / 2;
            $newInternal->size = $this->MAX - ($this->MAX + 1) / 2;
            for ($i = 0, $j = $cursor->size + 1; $i < $newInternal->size; $i++, $j++) {
                $newInternal->key[$i] = $virtualKey[$j];
            }
            for ($i = 0, $j = $cursor->size + 1; $i < $newInternal->size + 1; $i++, $j++) {
                $newInternal->ptr[$i] = $virtualPtr[$j];
            }
            if ($cursor === $this->root) {
                $newRoot = new Node();
                $newRoot->key[0] = $cursor->key[$cursor->size];
                $newRoot->ptr[0] = $cursor;
                $newRoot->ptr[1] = $newInternal;
                $newRoot->IS_LEAF = false;
                $newRoot->size = 1;
                $this->root = $newRoot;
            } else {
                $this->insertInternal($cursor->key[$cursor->size], $this->findParent($this->root, $cursor), $newInternal);
            }
        }
    }

    private function findParent($cursor, $child) {
        $parent = null;
        if ($cursor->IS_LEAF || $cursor->ptr[0]->IS_LEAF) {
            return null;
        }
        for ($i = 0; $i < $cursor->size + 1; $i++) {
            if ($cursor->ptr[$i] === $child) {
                $parent = $cursor;
                return $parent;
            } else {
                $parent = $this->findParent($cursor->ptr[$i], $child);
                if ($parent !== null) {
                    return $parent;
                }
            }
        }
        return $parent;
    }

    public function display($cursor,$level,&$arr) {
        if ($cursor !== null) {
            if($arr[$level])
            if (!isset($arr[$level])) {
                $arr[$level] = [];
            }
            for ($i = 0; $i < $cursor->size; $i++) {
                $p=$cursor->key[$i];
                $arr[$level][] = $p;
            }
            echo "\n";
            if ($cursor->IS_LEAF !== true) {
                for ($i = 0; $i < $cursor->size + 1; $i++) {
                    $this->display($cursor->ptr[$i],$level+1,$arr);
                }
            }
        }
    }

    public function getRoot() {
        return $this->root;
    }
}

?>
