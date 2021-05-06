<template>
    <div>
        <section class="hero is-primary is-fullheight">
        <div class="hero-body">
            <div class="container">
            <div class="columns is-centered">
                <div class="column is-5-tablet is-4-desktop is-3-widescreen">
                <div class="box">
                    <p class="notification is-danger" v-if="errors.account" v-text="errors.account[0]"></p>
                    <div class="field">
                    <label for="" class="label">Username</label>
                    <p class="notification is-danger" v-if="errors.username" v-text="errors.username[0]"></p>
                    <div class="control has-icons-left">
                        <input type="email" placeholder="e.g. csh124h" class="input" required v-model="form.username">
                        <span class="icon is-small is-left">
                            <i class="fas fa-info-circle"></i>
                        </span>
                    </div>
                    </div>
                    <div class="field">
                    <label for="" class="label">Password</label>
                    <p class="notification is-danger" v-if="errors.password" v-text="errors.password[0]"></p>
                    <div class="control has-icons-left">
                        <input type="password" placeholder="*******" class="input" required v-model="form.password">
                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                    </div>
                    <div class="field">
                    <button class="button is-success" @click.prevent="loginUser()">
                        Login
                    </button>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                form: {
                    username: '',
                    password: ''
                },
                errors:[]
            }
        },
        methods: {
            loginUser() {
                axios.post('/api/login', this.form).then(() =>{
                    // Show success message
                    this.$alert("You have been login successfully!");
                    this.$router.push({ name: "Dashboard" });
                }).catch((error) =>{
                    if (!error.response.data) return;
                    this.errors = error.response.data;
                    // this.errors = error.response.data.errors;
                })
            }
        },
    }
</script>