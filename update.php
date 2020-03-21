<?php
ini_set("allow_url_fopen", 1);

$json = file_get_contents('https://launchermeta.mojang.com/mc/game/version_manifest.json');
$obj = json_decode($json);

// set snapshot or release
$version = 'snapshot';
// set false to save last snapshot
$overwrite = false;

$latest = $obj->latest->$version;
$versionJson = file_get_contents($obj->versions[0]->url);
$versionObj = json_decode($versionJson);

shell_exec('wget ' . $versionObj->downloads->server->url);

if ($overwrite) {
	rename('server.jar', 'server' . $latest . '.jar');
}
