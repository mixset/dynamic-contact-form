<?php
use Core\Helpers;
?>
<section>
    <form action="" method="POST" class="contact-form">
        <fieldset>
            <dl>
                <dt><label for="firstname">Imię:</label>*</dt>
                    <dd><input type="text" name="firstname" id="firstname" value="<?= Helpers::old('firstname');?>"></dd>
                <dt><label for="lastname">Nazwisko:</label></dt>
                    <dd><input type="text" name="lastname" id="lastname" value="<?= Helpers::old('lastname');?>"></dd>
                <dt><label for="email">E-mail:</label>*</dt>
                    <dd><input type="text" name="email" id="email" value="<?= Helpers::old('email');?>"></dd>
                <dt><label for="content">Treść:</label>*</dt>
                    <dd><textarea id="content" name="content" rows="4" cols="30"><?= Helpers::old('content');?></textarea></dd>
                <dt><input type="submit" value="Wyślij" name="save"></dt>
            </dl>
        </fieldset>
    </form>
</section>