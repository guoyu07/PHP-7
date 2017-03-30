<?php
$arrWord = array('word1', 'word2', 'word3');
$resTrie = trie_filter_new(); //create an empty trie tree
foreach ($arrWord as $k => $v) {
    trie_filter_store($resTrie, $v);
}
trie_filter_save($resTrie, __DIR__ . '/blackword.tree');

$resTrie = trie_filter_load(__DIR__ . '/blackword.tree');

$strContent = 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww word2 word1';
$start = microtime(true);
$arrRet = trie_filter_search($resTrie, $strContent);

//$arrRet = strpos($strContent , 'word3');
$end    = microtime(true);

echo "spend : ",$end-$start,"\n";
print_r($arrRet); //Array(0 => 6, 1 => 5)
echo substr($strContent, $arrRet[0], $arrRet[1]); //word2
$arrRet = trie_filter_search_all($resTrie, $strContent);
print_r($arrRet); //Array(0 => Array(0 => 6, 1 => 5), 1 => Array(0 => 12, 1 => 5))


$arrRet = trie_filter_search($resTrie, 'hello word');
print_r($arrRet); //Array()

trie_filter_free($resTrie);
