<?php $validations = flash()->get('validations'); ?>

<div class="bg-base-300 rounded-box w-full text-3xl font-bold pt-20 overflow-hidden flex flex-col items-center">
  <form action="/show" method="POST" class="max-w-md flex flex-col gap-4">
    <div class="text-center">Digite a sua senha novamente para começar a ver todas as suas notas descriptografadas</div>

    <label class="form-control">
      <div class="label">
        <span class="label-text text-sm">Senha</span>
      </div>

      <input type="password" name="password" class="input input-bordered w-full" />

      <?php if (isset($validations['password'])) { ?>
        <div class="mt-1 text-xs text-error"><?= $validations['password'][0] ?></div>
      <?php } ?>
    </label>

    <button class="btn btn-primary">Abrir minhas notas</button>
  </form>
</div>