<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

	<?php require "partials/nav.php" ?>

	<div class="container my-3">
		<div>
			<form action="search.php" method="get">
				<div class="btn-group">
					<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filter" aria-expanded="false" aria-controls="filter"><i class="bi bi-funnel-fill"></i><span> Filter</span></button>
					<button class="btn btn-primary" id="search" type="button"><i class="bi bi-search"></i><span> Szukaj </span><span>
						<div class="badge bg-light text-primary found-count"></div>
					</span></button>
				</div>
				<div class="collapse mt-3" id="filter">
					<div class="card card-body">
						<div class="row">
							<div class="col-md-4">
								<h5>Składniki</h5>
								<ul class="list-unstyled">
									<?php foreach (MenuFunctions::get_all_toppings() as $topping) { ?>
										<li>
											<div class="form-check">
												<input class="form-check-input ingridient-check" type="checkbox" value="<?= $topping['id'] ?>" name="toppings[]" id="checkbox<?= $topping['topping'] ?>">
												<label class="form-check-label" for="checkbox<?= $topping['topping'] ?>"><?= $topping['topping'] ?></label>
											</div>
										</li>
									<?php } ?>
								</ul>
							</div>
							<div class="col-md-4">
								<h5>Rozmiar</h5>
								<ul class="list-unstyled">
									<?php foreach (MenuFunctions::get_all_sizes() as $size) { ?>
										<li>
											<div class="form-check">
												<input class="form-check-input size-check" type="radio" value="<?= $size ?>" name="size" id="radio<?= $size ?>" <?= $size == 25 ? "checked" : "" ?>>
												<label class="form-check-label" for="radio<?= $size ?>"><?= $size ?>cm</label>
											</div>
										</li>
									<?php } ?>
								</ul>
							</div>
							<div class="col-md-4">
								<h5>Cena</h5>
								<div>
									<div class="price-input w-100 d-flex">
										<div class="field">
											<span>Min</span>
											<input type="number" step="0.01" class="input-min form-control" name="min-price" value="0" min=0 max=100>
										</div>
										<div class="separator">-</div>
										<div class="field">
											<span>Max</span>
											<input type="number" step="0.01" class="input-max form-control" name="max-price" value="100" min=0 max=100> 
										</div>
									</div>
									<div class="slider mt-3">
										<div class="progress"></div>
										<div class="range-input">
											<input type="range" class="range-min" min=0 max=100 step="0.01" value="0">
											<input type="range" class="range-max" min=0 max=100 step="0.01" value="100">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>

		<div class="pizza-grid mt-3">
			
		</div>

	</div>

	<script src="./js/multi-range.js"></script>
	<script src="./js/filter.js"></script>



	<?php require "partials/footer.php"; ?>



</body>



</html>