<div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
	<div>
		<label class="text-gray-700" for="name">Pizza name</label>
		<input id="name" name="name" type="text" required value="<?php echo isset($pizza) ? $pizza['name'] : null ?>" <?php echo isset($disabled) ? 'disabled' : '' ?>>
	</div>
    <div>
        <label class="text-gray-700" for="category_name">Category name</label>
        <input id="category_name" name="category_name" type="text" required value="<?php echo isset($pizza) ? $pizza['category_name'] : null ?>" <?php echo isset($disabled) ? 'disabled' : '' ?>>
    </div>
    <div>
        <label class="text-gray-700" for="is_vegetarian">Vegetarian ?</label>
    </div>
</div>
