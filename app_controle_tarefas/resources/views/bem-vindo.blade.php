<p class="text-4xl text-center font-bold">Bem-vindo(a) ao sistema de tarefas!</p>

@Auth
    <p class="text-2xl text-center font-bold">Seja bem-vindo(a), {{ Auth::user()->name }}!</p>
@endAuth

@Guest
    <p class="text-2xl text-center font-bold">Olá, Visitante!</p>
@endGuest