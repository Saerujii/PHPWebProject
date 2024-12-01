<?php
include_once '../../model/Control3Files.php';

if (($sourcePath = filter_input(INPUT_POST, 'sourcePath')) != null AND
    ($destPath = filter_input(INPUT_POST, 'destPath')) != null){
    
    $filterDept = (filter_input(INPUT_POST, 'filterDept') != '') ? filter_input(INPUT_POST, 'filterDept') : '*';
    $filterRole = (filter_input(INPUT_POST, 'filterRole') != '') ? filter_input(INPUT_POST, 'filterRole') : '*';
    $saveNotMatching = (filter_input(INPUT_POST, 'notMatching') == 'on') ? true : false;
    $storage = [];
    
    $output1 = extractUsers($sourcePath, $storage, $filterDept);
    $output2 = saveRoles($destPath, $storage, $filterRole, $saveNotMatching);
    
    print 'USUARIS FILTRATS:<br>';
    foreach ($storage as $user){
        $user = explode('-', $user);
        $inactive = (isset($user[4])) ? '['.intval($user[4]).']' : '';
        print $user[0].'.'.$user[1].'('.$user[2].')'.'='.$user[3].$inactive.'<br>';
    }
    print "<br>Linies guardades $output2";
}
else{
    print 'Introdueix destí del fitxer a llegir (Source Path) i el destí del fitxer a on escriure (Dest Path)!';
}

print "  <p><a href=\"../../views/activities/ArrayAssocView.html#control3\">Volver a la página anterior</a></p>\n";


