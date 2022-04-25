<!--
A fully spec-compliant TodoMVC implementation
https://todomvc.com/
-->

<script>
const STORAGE_KEY = 'vue-todomvc'

const filters = {
  all: (todos) => todos,
  active: (todos) => todos.filter((todo) => !todo.completed),
  completed: (todos) => todos.filter((todo) => todo.completed)
}

export default {
  // app initial state
  data: () => ({
    todos: [],
    editedTodo: null,
    visibility: 'all',
    show: false,
  }),

  // watch todos change for localStorage persistence
  watch: {
    todos: {
      handler(todos) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(todos))
      },
      deep: true
    }
  },

  mounted() {
    window.addEventListener('hashchange', this.onHashChange)
    this.onHashChange()
  },

  computed: {
    filteredTodos() {
      return filters[this.visibility](this.todos)
    },
    remaining() {
      return filters.active(this.todos).length
    }
  },

  // methods that implement data logic.
  // note there's no DOM manipulation here at all.
  methods: {

    addTodo(e) {
      e.preventDefault();
      const value = document.getElementById('questions').value.trim()
      if (!value) {
        return
      }
      this.todos.push({
        id: Date.now(),
        title: value,
        completed: false
      })
      e.target.value = ''
    },

    removeTodo(todo) {
      this.todos.splice(this.todos.indexOf(todo), 1)
    },
    
    onHashChange() {
      var visibility = window.location.hash.replace(/#\/?/, '')
      if (filters[visibility]) {
        this.visibility = visibility
      } else {
        window.location.hash = ''
        this.visibility = 'all'
      }
    },

    checkFunction(e){
        if (e.target.checked){
            this.show = true;
        }
        else this.show = false;
    },
  }
}
</script>

<template>

  <section class="todoapp">

    <fieldset>
        <input v-on:click="checkFunction" type="checkbox" id="checkbox_2" name="extra_questions"
            value="0">
        <label for="checkbox_2">Pridėti papildomų  klausimų į anketą</label>
    </fieldset>

    <div v-if="show">
    <header class="header">
      <h1>Klausimai</h1>
      <input
        id="questions"
        class="new-todo"
        autofocus
        placeholder="Papildomas klausimas"
      >
      <i @click="addTodo"> + </i>
    </header>
    <section class="main" v-show="todos.length">
      <ul class="todo-list">
        <li
          v-for="todo in filteredTodos"
          class="todo"
          :key="todo.id"
          :class="{ completed: todo.completed, editing: todo === editedTodo }"
        >
          <div class="view">
            <h2>
              {{todo.title}}
              <i @click="removeTodo(todo)">x</i>
            </h2>
          </div>
        </li>
      </ul>
    </section>
    </div>
  </section>
</template>
