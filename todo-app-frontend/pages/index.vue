<template>
  <div class="w-full h-screen">
    <h1 class="mt-6 ml-6 font-bold text-[40px]">
      List Todo
    </h1>

    <!-- Tampilkan pesan jika tidak ada data todo -->
    <div v-if="todos.length === 0" class="mt-4 ml-6 text-gray-500">
      Tidak ada todo untuk ditampilkan.
    </div>

    <!-- Tampilkan todo jika ada data -->
    <div v-else class="flex flex-wrap gap-4 p-6">
      <TodoCard
        class="mt-5"
        v-for="todo in todos"
        :key="todo.id"
        :todo="todo"
        @todoDeleted="loadTodos"
      />
    </div>
  </div>
</template>

<style>
body {
  margin: 0;
  padding: 0;
}
.w-full {
  width: 100%;
}
.h-screen {
  height: 100vh;
}
</style>

<script>
import TodoCard from "~/components/TodoCard.vue";
import axios from "axios";

export default {
  components: {
    TodoCard,
  },
  data() {
    return {
      todos: [],
    };
  },
  mounted() {
    this.loadTodos();
  },
  methods: {
    async loadTodos() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/todo");
        this.todos = response.data.data;
      } catch (error) {
        console.error("Error fetching todos", error);
      }
    },
  },
};
</script>
