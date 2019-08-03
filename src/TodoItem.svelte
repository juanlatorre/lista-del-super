<script>
  import { createEventDispatcher } from "svelte";

  const dispatch = createEventDispatcher();

  function remove() {
    dispatch("remove", { id });
  }

  function toggleStatus() {
    let newStatus = !complete;
    dispatch("toggle", { id, newStatus });
  }

  export let id; // Document ID
  export let text;
  export let complete;
</script>

<style>
  .is-complete {
    text-decoration: line-through;
    color: green;
  }

  span {
    justify-self: center;
    align-self: center;
    padding-right: 3em;
  }

  li {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }
</style>

<li>
  {#if complete}
    <span class="is-complete">{text}</span>
  {:else}
    <span>{text}</span>
  {/if}

  <div class="botones">
    {#if complete}
      <button class="button" on:click={toggleStatus}>❌</button>
    {:else}
      <button class="button" on:click={toggleStatus}>✔️</button>
    {/if}
    <button class="button" on:click={remove}>🗑️</button>
  </div>
</li>
