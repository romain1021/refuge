<?php
echo '<div class=debug>';
echo '--------DEBUG ZONE--------';
echo '<br>';
echo 'id user actuelle : ';
var_dump($_SESSION['user_id']);
echo '<br>';
echo 'statut user actuelle : ';
var_dump($_SESSION['user_statut']);
echo '<br>';
echo '--------------------------';
echo '<br>';
echo '</div>';