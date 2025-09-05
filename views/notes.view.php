<div class="bg-base-300 rounded-l-box w-56 flex flex-col divide-y divide-gray-700 overflow-hidden">
  <?php foreach($notes as $note): ?>
    <a href="/notes?id=<?=$note->id?>"
      class="
        w-full p-2 cursor-pointer hover:bg-base-200
        <?php if ($note->id == $noteSelected->id): ?> bg-base-200 <?php endif; ?>
      "
    >
      <?=$note->title?> <br/>
            
      <span class="text-xs">id: <?=$note->id?></span>
    </a>
  <?php endforeach; ?>
</div>

<div class="bg-base-200 rounded-r-box w-full p-10 flex flex-col space-y-6">
  <fieldset class="fieldset">
    <legend class="fieldset-legend">Título</legend>
    <input value="<?=$noteSelected->title?>" name="title" type="text" class="input w-full" placeholder="Type here" />
  </fieldset>

  <fieldset class="fieldset">
    <legend class="fieldset-legend">Sua nota</legend>
    <textarea name="note" class="textarea h-24 w-full" placeholder="Bio"><?=$noteSelected->note?></textarea>
  </fieldset>

  <div class="flex justify-between items-center">
    <button class="btn btn-error">Deletar</button>
    <button class="btn btn-primary">Atualizar</button>
  </div>
</div>