<?php $validations = flash()->get('validations'); ?>

<div class="bg-base-300 rounded-l-box w-56 flex flex-col divide-y divide-gray-700 overflow-hidden">

  <?php foreach ($notes as $note) { ?>
    <a href="/notes?id=<?= $note->id?><?= request()->get('search', '', '&search=') ?>"
      class="
        w-full p-2 cursor-pointer hover:bg-base-200
        <?php if ($note->id == $noteSelected->id) { ?> bg-base-200 <?php } ?>
      "
    >
      <?= $note->title?> <br/>
            
      <span class="text-xs">id: <?= $note->id ?> ~ criado: <?= $note->createdAt()->locale('pt_BR')->diffForHumans() ?></span>
    </a>
  <?php } ?>

</div>

<div class="bg-base-200 rounded-r-box w-full p-10 flex flex-col space-y-6">
  <form action="/note" method="POST" id="form-update">
    <input type="hidden" name="__method" value="PUT" />
    <input type="hidden" name="id" value="<?= $noteSelected->id ?>" />

    <fieldset class="fieldset">
      <legend class="fieldset-legend">Título</legend>
      <input value="<?= $noteSelected->title?>" name="title" type="text" class="input w-full" placeholder="Type here" />
    </fieldset>

    <fieldset class="fieldset">
      <legend class="fieldset-legend">Sua nota</legend>
      <textarea name="note"
        <?php if (! session()->get('show')) { ?>
          disabled
        <?php } ?>
        class="textarea h-24 w-full" placeholder="Escreva aqui..."><?= $noteSelected->note()?></textarea>
    </fieldset>
  </form>

  <div class="flex justify-between items-center">
    <form action="/note" method="POST">
      <input type="hidden" name="__method" value="DELETE" />

      <input type="hidden" name="id" value="<?= $noteSelected->id ?>"/>

      <button class="btn btn-error" type="submit">Deletar</button>
    </form>

    <button class="btn btn-primary" type="submit" form="form-update">Atualizar</button>
  </div>
</div>