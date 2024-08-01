@if(empty($error) && empty(session('error')))
<?php 

echo '<pre>'; print_r( $content ); echo '</pre>';
?>
@else
<?php 

echo '<pre>'; print_r( $error ); echo '</pre>';
echo '<pre>'; print_r( session('error') ); echo '</pre>';

?>
@endif