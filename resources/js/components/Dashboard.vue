<template>
    <div>
        Dashboard <br>
        Name: {{user.name}}
        Email: {{user.email}} <br>
        <button @click.prevent="logout()">Logout</button>
        <button target="_blank" @click.prevent="exportFile()">Export</button>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                user: null
            }
        },
        mounted() {
            axios.get('/api/user').then((res) =>{
                this.user = res.data
            })
        },
        methods: {
            logout(){
                axios.post('/api/logout').then(() =>{
                    this.$alert("You have been logout successfully!");
                    this.$router.push({ name: "Home" });
                })
            },
            exportFile() {
                location.href = "/users/export";
            },
        }
    }
</script>