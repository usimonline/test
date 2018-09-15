<header>
		<section>
			<div>

				<?php if (empty($_SESSION['client_email'])): ?>
					<label onclick="document.forms.callback.className=document.forms.callback.className==&#39;hidden&#39;?&#39;showed&#39;:&#39;hidden&#39;;">Личный кабинет</label>
				<form name="callback" action="check_login.php" method="get" class="hidden">
					<input type="hidden" name="callback" value="">
					<section>
						<div>
							Email:<br><input type="text" name="client_email" ><br>
							Пароль:<br><input type="text" name="client_pass" style=" margin-top: 5px;"><br>
						</div>

						<div>
							<div style="text-align: right;"><label onclick="document.forms.callback.className=&#39;hidden&#39;;">Закрыть</label></div>
							<p>Регистрация.</p>
							<button type="submit" name="submit" style="font-size: 18px; margin: 15px 0 0; background: #590;">Войти в ЛК</button><br>
						</div>
					</section>
				</form>
				<?php else: ?>
					<button><a href="kabinet/profile.php" style="color:white;" ><?php echo $_SESSION['client_name']; ?>! Войти в ЛК</a></button>
				<?php endif ?>
			</div>

		</section>

</header>