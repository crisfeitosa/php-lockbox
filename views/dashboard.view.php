<div class="mx-auto mx-auto max-w-screen-lg">
  <div class="navbar bg-base-100 shadow-sm">
    <div class="flex-1">
      <a class="btn btn-ghost text-xl">LockBox</a>
    </div>
    <div class="flex-none">
      <ul class="menu menu-horizontal px-1">
        <li><a>👁️</a></li>
        <li>
          <details>
            <summary><?= $user->name ?></summary>
            <ul class="bg-base-100 rounded-t-none p-2">
              <li><a href="/logout">Logout</a></li>
            </ul>
          </details>
        </li>
      </ul>
    </div>
  </div>
</div>