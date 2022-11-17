<?php
require_once './model/Speaker.php';
require_once './model/Animal.php';
require_once './model/Dog.php';
require_once './model/Cat.php';
require_once './model/Clock.php';

function displaySpeaker(array $list): void
{
    foreach ($list as $elem) {
        echo $elem . "\n";
    }
}
 
function makeThemTalk(array $list ): void {
    foreach ($list as $elem) {
        $elem->talk();
    }
}

function main()
{
    $speakerList = array();
    array_push($speakerList, new Clock());
    array_push($speakerList, new Dog('Tobby', 'Grey'));
    array_push($speakerList, new Cat('Misifu', true));

    displaySpeaker($speakerList);
    makeThemTalk($speakerList);
};

main();
