<template>
  <div class="w-full h-screen flex items-center justify-center">
    <NuxtLink to="/" class="btn btn-primary mr-5 mt-[-350px]">Kembali</NuxtLink>
    <div class="w-[400px] bg-indigo-800 rounded-lg p-6 shadow-md mt-[-100px]">
      <h2 class="text-2xl font-bold mb-6 text-white">Tambah Todo</h2>

      <div class="mb-4">
        <label for="judul" class="text-white">Judul Todo:</label>
        <input
          v-model="judul"
          id="judul"
          type="text"
          placeholder="Masukkan judul todo kamu"
          class="input input-bordered input-primary w-full"
        />
      </div>

      <div class="mb-4">
        <label for="keterangan" class="text-white">Keterangan:</label>
        <input
          v-model="keterangan"
          id="keterangan"
          type="text"
          placeholder="Tambahkan keterangan untuk todo"
          class="input input-bordered input-primary w-full"
        />
      </div>

      <button @click="tambahTodo" class="btn btn-primary w-full">Tambah Todo</button>

      <div v-if="showNotification" class="notification">
        {{ notificationMessage }}
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      judul: '',
      keterangan: '',
      showNotification: false,
      notificationMessage: '',
    };
  },
  methods: {
    tambahTodo() {
      const newTodo = {
        judul: this.judul,
        keterangan: this.keterangan,
      };

      axios.post('http://127.0.0.1:8000/api/todo', newTodo)
        .then(response => {
          console.log(response.data);
          this.showNotificationPopup('Todo berhasil ditambahkan');
          // Redirect ke halaman index.vue
          this.$router.push('/');
        })
        .catch(error => {
          console.error('Error adding todo', error);
          this.showNotificationPopup('Gagal menambahkan todo');
        });

      this.judul = '';
      this.keterangan = '';
    },
    showNotificationPopup(message) {
      this.notificationMessage = message;
      this.showNotification = true;
      setTimeout(() => {
        this.showNotification = false;
      }, 3000); // Menyembunyikan notifikasi setelah 3 detik
    },
  },
};
</script>

<style scoped>
.notification {
  position: fixed;
  top: 20px;
  right: 20px;
  background-color: #4CAF50;
  color: white;
  padding: 15px;
  border-radius: 5px;
  display: inline-block;
}
</style>
