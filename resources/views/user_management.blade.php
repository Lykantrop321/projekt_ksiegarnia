<!-- resources/views/user_management.blade.php -->
@extends('layouts.app')

@section('content')
<div id="userManagementApp">
  <h1>User Management</h1>
  <ul>
    <li v-for="user in users" :key="user.id">
      {{ user.name }} ({{ user.email }})
      <button @click="editUser(user)">Edit</button>
      <button @click="deleteUser(user.id)">Delete</button>
      <select v-model="user.selectedRoleId" @change="updateUserRole(user)">
        <option v-for="role in roles" :value="role.id">{{ role.name }}</option>
      </select>
    </li>
  </ul>
</div>
@endsection

@section('scripts')
<script>
new Vue({
    el: '#userManagementApp',
    data: {
        users: [],
        roles: []
    },
    created() {
        this.fetchUsers();
        this.fetchRoles();
    },
    methods: {
        fetchUsers() {
            axios.get('/users').then(response => {
                this.users = response.data;
                this.users.forEach(user => {
                    if (user.roles.length > 0) {
                        user.selectedRoleId = user.roles[0].id;
                    }
                });
            });
        },
        fetchRoles() {
            axios.get('/roles').then(response => {
                this.roles = response.data;
            });
        },
        editUser(user) {
            axios.post(`/users/${user.id}`, {
                name: user.name,
                email: user.email,
                roles: [user.selectedRoleId]
            }).then(response => {
                alert('User updated');
            }).catch(error => {
                alert('Error updating user');
            });
        },
        deleteUser(id) {
            axios.delete(`/users/${id}`).then(response => {
                this.fetchUsers(); // Reload list after delete
                alert('User deleted');
            }).catch(error => {
                alert('Error deleting user');
            });
        },
        updateUserRole(user) {
            this.editUser(user);
        }
    }
});
</script>
@endsection
