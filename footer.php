<?php
$f = @fopen("changelog.txt", 'r');
$version = fgets($f);
fclose($f);
?>
<footer class="sticky-footer bg-white">
	<div class="container my-auto">
		<div class="copyright text-center my-auto">
			<span>Producto-Desayuno <?php echo $version ?> - Copyright &copy; <a target="_blank" href="https://www.simonecelia.it">www.simonecelia.it</a> 2023</span>
		</div>
	</div>
</footer>