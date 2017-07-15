<?php include_once '../' . strtolower(APP_NAME) . '/public/fineuploader/templates/template.html'; ?>

<?php if(!isset($this->organismo)) : ?>
<section id="faq" class="faq section">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

				<h2 class="title col-md-offset-1">Imagens</h2>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1">
						<div id="fine-uploader-manual-trigger"></div>
						<div id="image_inputs" style="display: none;"></div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>

<?php require 'views/front/organismo/cadastro_organismo/image_upload/image_upload.js.php'; ?>

<?php endif ?>