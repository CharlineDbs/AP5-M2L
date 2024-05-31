<div class="articles">
			<div class="article">
				<a class="anchor" id="contrat"></a>
				<br>
				<h3><?php echo $_SESSION["identification"]["NOM"]?> <?php echo $_SESSION["identification"]["PRENOM"]?></h3>
				<br>
                <?php $formContratConsult->afficherFormulaire(); ?>
				<br><br><br><br><br>
				<?php echo $listeBulletin; ?>
					
				<embed src=http://10.100.0.6/~cdubos2/bulletin/bulletin<?php echo $_SESSION["identification"]["IDUSER"]?> width=800 height=500 type='application/pdf' style="margin-left: 500px; margin-top: -150px;"/>
			</div>	