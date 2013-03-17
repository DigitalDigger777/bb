<div class="conteiner-fluid">
    <div class="row-fluid">
        <div class="span4 offset4 well">
            <form action="<?php echo $this->createUrl('site/login');?>" method="POST">
                <fieldset>
                    <label for="username">Логін</label>
                    <input class="span12" type="text" name="LoginForm[username]" id="username" />
                    <label for="password">Пароль</label>
                    <input class="span12" type="password" name="LoginForm[password]" id="password" />
                    <button class="btn btn-primary" type="submit">Вхід</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>