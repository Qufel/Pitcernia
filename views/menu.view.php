<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

	<?php require "partials/nav.php" ?>

	<div class="container my-3">
		<div>
			<form action="search.php" method="get">
				<div class="btn-group">
					<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filter" aria-expanded="false" aria-controls="filter">
						<i class="fi fi-rr-filter"></i> Filter
					</button>
					<button class="btn btn-primary" type="submit">
						<i class="fi fi-rr-search"></i> Szukaj
					</button>
				</div>
				<div class="collapse mt-3" id="filter">
					<div class="card card-body">
						<div class="row">
							<div class="col-md-4">
								<h5><i class="fi fi-rr-salad"></i> Składniki</h5>
								<ul class="list-unstyled">
									<?php foreach (MenuFunctions::get_all_toppings() as $topping) { ?>
										<li>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="<?= $topping['id'] ?>" name="toppings[]" id="checkbox<?= $topping['topping'] ?>">
												<label class="form-check-label" for="checkbox<?= $topping['topping'] ?>"><?= $topping['topping'] ?></label>
											</div>
										</li>
									<?php } ?>
								</ul>
							</div>
							<div class="col-md-4">
								<h5><i class="fi fi-rr-expand-arrows"></i> Rozmiar</h5>
								<ul class="list-unstyled">
									<?php foreach (MenuFunctions::get_all_sizes() as $size) { ?>
										<li>
											<div class="form-check">
												<input class="form-check-input" type="radio" value="<?= $size ?>" name="size" id="radio<?= $size ?>">
												<label class="form-check-label" for="radio<?= $size ?>"><?= $size ?>cm</label>
											</div>
										</li>
									<?php } ?>
								</ul>
							</div>
							<div class="col-md-4">
								<h5><i class="fi fi-rr-coins"></i> Cena</h5>
								Dodać jakiś range tutaj
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<?php
			$pizzas = json_decode($_COOKIE['pizzas']) ?? [];
			?>

			<?php if(!$pizzas):?>

				<div class="text-center mt-3">

					<h3>Brak wyników</h3>
					<p>Spróbuj z innymi składnikami.</p>

				</div>

			<?php endif; ?>
		<div class="pizza-grid mt-3">

			<?php foreach ($pizzas as $pizza) : ?>
				<div class="pizza-card card bg-light text-dark">
					<img src="./assets/<?= $pizza->img_src ?>" alt="Zdjęcie pizzy <?= $pizza->name ?>" class="card-img-top">
					<div class="card-body d-flex flex-column">
						<div class="card-title d-flex">
							<h4 class="align-self-start">Pizza <?= $pizza->name ?></h4>

						</div>
						<div class="text-center">
							<p><?= implode(', ', $pizza->toppings) ?></p>
						</div>
						<div class="d-flex">
							<button class="btn btn-primary">Zamów</button>
						</div>
					</div>
				</div>
			<?php endforeach;
			unset($_COOKIE['pizzas']); ?>

		</div>

	</div>

</body>

</html>