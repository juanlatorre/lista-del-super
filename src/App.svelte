<script>
  import TodoItem from "./TodoItem.svelte";
  import { db } from "./firebase";
  import { collectionData } from "rxfire/firestore";
  import { startWith } from "rxjs/operators";

  // Form Text
  let text = "";

  // Query requires an index, see screenshot below
  const query = db.collection("todos");

  const todos = collectionData(query, "id").pipe(startWith([]));

  function add() {
    db.collection("todos").add({ text, complete: false });
    text = "";
  }

  function updateStatus(event) {
    const { id, newStatus } = event.detail;
    db.collection("todos")
      .doc(id)
      .update({ complete: newStatus });
  }

  function removeItem(event) {
    const { id } = event.detail;
    db.collection("todos")
      .doc(id)
      .delete();
  }
</script>

<style>
  input {
    display: block;
  }

  .container {
    margin-top: 3em;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  ul {
    margin-top: 1em;
  }

  div.field {
    margin-top: 1em;
  }
</style>

<div class="container">
  <h1 class="title is-size-1-desktop is-size-3-touch">
    Lista del Supermercado
  </h1>

  <div class="field has-addons">
    <div class="control">
      <input
        class="input"
        type="text"
        placeholder="Agregar..."
        bind:value={text} />
    </div>
    <div class="control">
      <button class="button is-dark" on:click={add}>➕</button>
    </div>
  </div>

  <ul>
    {#each $todos as todo}
      <TodoItem {...todo} on:remove={removeItem} on:toggle={updateStatus} />
    {/each}
  </ul>
</div>
