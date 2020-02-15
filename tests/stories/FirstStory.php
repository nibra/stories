<?php

// create a new story
$story = newStoryFor("Storyplayer")
    ->inGroup("Web Pages")
    ->called("Can Get Title Of A Web Page")
;

// compatibility: Storyplayer v2
$story->requiresStoryplayerVersion(2);

// the Action phase
$story->addAction(function () {
    $checkpoint = getCheckpoint();

    usingBrowser()->gotoPage("http://php.net");
    $checkpoint->title = fromBrowser()->getTitle();
});

// the PostTestInspection phase
$story->addPostTestInspection(function () {
    $checkpoint = getCheckpoint();

    assertsObject($checkpoint)->hasAttribute("title");
    assertsString($checkpoint->title)->equals("PHP: Hypertext Preprocessor");
});
