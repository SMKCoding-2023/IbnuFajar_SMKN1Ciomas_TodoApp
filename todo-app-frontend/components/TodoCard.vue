<template>
  <div class="card card-compact w-96 bg-base-100 shadow-xl">
    <div class="card-body">
      <h2 class="card-title">{{ todo.judul }}</h2>
      <p>{{ todo.keterangan }}</p>
      <div class="card-actions justify-end pt-4">
        <button @click="hapusTodo" class="btn bg-red-600 text-white">Hapus</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    todo: {
      type: Object,
      required: true,
    },
  },
  methods: {
    async hapusTodo() {
      try {
        const response = await axios.delete(`http://127.0.0.1:8000/api/todo/${this.todo.id}`);
        console.log(response.data.message);
        // Jika berhasil dihapus, emit event untuk memberi tahu parent component bahwa todo telah dihapus
        this.$emit('todoDeleted');
      } catch (error) {
        console.error('Error deleting todo', error);
      }
    },
  },
};
</script>
