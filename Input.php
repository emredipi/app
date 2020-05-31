<?php

class Input
{
	public static function text($label, $name, $value, $props = ["type" => "text"])
	{
		?>
        <div class="form-group">
            <label for="<?= $name ?>"><?= $label ?></label>
            <input name="<?= $name ?>"
                   value="<?= $value ?>" <?php foreach ($props as $key => $value) echo "{$key}='{$value}'" ?>
                   class="form-control<?= (Request::error($name)) ? ' is-invalid' : null ?>"
                   id="<?= $name ?>">
			<?php if (Request::error($name)): ?>
                <div class="invalid-feedback">
					<?php foreach (Request::error($name) as $error): ?>
                        <p><?= $error ?></p>
					<?php endforeach ?>
                </div>
			<?php endif ?>
        </div>
		<?php
	}

	public static function select($label, $name, $value, $options, $props = [])
	{
		?>
        <div class="form-group">
            <label for="<?= $name ?>"><?= $label ?></label>
            <select name="<?= $name ?>"
                    class="form-control<?= (Request::error($name)) ? ' is-invalid' : null ?>" id="<?= $name ?>"
                <?php foreach ($props as $key => $value):
                    echo "{$key}='{$value}'";
				endforeach ?>
            >
                <?php foreach ($options as $optionKey => $optionLabel): ?>
                    <option <?php if ($optionKey == $value) {
						echo 'selected="selected"';
					} ?> value="<?= $optionKey ?>"><?php echo ucfirst($optionLabel); ?></option>
				<?php endforeach; ?>
            </select>
			<?php if (Request::error($name)): ?>
                <div class="invalid-feedback">
					<?php foreach (Request::error($name) as $error): ?>
                        <p><?= $error ?></p>
					<?php endforeach ?>
                </div>
			<?php endif ?>
        </div>
		<?php
	}

}
