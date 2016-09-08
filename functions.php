<?php

function XMLOpeningTag($TagName)
{
	return "<" . $TagName . ">";
}

function XMLClosingTag($TagName)
{
	return "</" . $TagName . ">";
}

function AddXMLTags($TagName, $Content)
{	
	return XMLOpeningTag($TagName) . $Content . XMLClosingTag($TagName);
}

function AddXMLTagsLine($TagName, $Content)
{
	return AddXMLTags($TagName, $Content) . PHP_EOL;
}
?>
