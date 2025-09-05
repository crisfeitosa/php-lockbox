<?php $validations = flash()->get('validations'); ?>

<div class="bg-base-300 rounded-l-box w-56 overflow-hidden">
  <div class="bg-base-200 p-4">+ Nova Nota</div>
</div>

<div class="bg-base-200 rounded-r-box w-full p-10 space-y-6">
  <form action="/notes/create" method="POST" class="flex flex-col space-y-6">
    <fieldset class="fieldset">
      <legend class="fieldset-legend">Título</legend>
      <input type="text" name="title" class="input w-full" />
      <?php if (isset($validations['title'])): ?>
        <div class="mt-1 text-xs text-error"><?= $validations['title'][0] ?></div>
      <?php endif; ?>
    </fieldset>

    <fieldset class="fieldset">
      <legend class="fieldset-legend">Sua nota</legend>
      <textarea class="textarea h-24 w-full" name="note"></textarea>
      <?php if (isset($validations['note'])): ?>
        <div class="mt-1 text-xs text-error"><?= $validations['note'][0] ?></div>
      <?php endif; ?>
    </fieldset>

    <div class="flex justify-end items-center">
      <button class="btn btn-primary">Salvar</button>
    </div>
  </form>
</div>