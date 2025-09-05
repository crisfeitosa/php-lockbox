<?php $validations = flash()->get('validations'); ?>

<div class="grid grid-cols-2">
  <div class="hero min-h-screen flex mx-auto">
    <div class="hero-content m-auto py-8">
      <div>
        <p class="py-2 text-xl">Bem Vindo ao</p>
        <h1 class="text-6xl font-bold">LockBox</h1>
        <p class="py-2 pb-4 text-xl">Onde você guarda <span class="italic">tudo</span> com segurança</p>
      </div>
    </div>
  </div>

  <div class="bg-white hero mr-40 min-h-screen text-black">
    <div class="hero-content my-auto">
      <form method="POST" action="/login">
        <div class="card">
          <div class="card-body">
            <div class="card-title text-xl">Faça o seu login</div>
            <?php require base_path('views/partials/_message.view.php'); ?>
            <label class="form-control mb-2">
              <div class="label">
                <span class="label-text text-black">Email</span>
              </div>

              <input
                type="text"
                name="email"
                class="input w-full max-w-xs bg-gray-100"
                value="<?= old('email') ?>"
                placeholder="Digite seu email"
              />

              <?php if (isset($validations['email'])): ?>
                <div class="mt-1 text-xs text-error"><?= $validations['email'][0] ?></div>
              <?php endif; ?>
            </label>

            <label class="form-control">
              <div class="label">
                <span class="label-text text-black">Senha</span>
              </div>

              <input
                type="password"
                name="password"
                class="input w-full max-w-xs bg-gray-100"
                placeholder="Digite sua senha"
              />

              <?php if (isset($validations['password'])): ?>
                <div class="mt-1 text-xs text-error"><?= $validations['password'][0] ?></div>
              <?php endif; ?>
            </label>

            <div class="card-actions mt-4">
              <button class="btn btn-primary btn-block">Login</button>
              <a href="/register" class="btn btn-link px-0">Quero me registrar</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>