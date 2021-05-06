<template>
    <div>
        <section class="hero is-primary is-fullheight">
        <div class="hero-body">
            <div class="container">
            <div class="columns is-centered">
                <div class="column is-5-tablet is-4-desktop is-3-widescreen">
                <div class="box">
                    <div class="field">
                        <label for="" class="label">Name</label>
                        <div class="control has-icons-left">
                            <input type="text" placeholder="e.g. ABC" class="input" required v-model="form.name">
                            <span class="icon is-small is-left">
                                <i class="fas fa-info-circle"></i>
                            </span>
                        </div>
                    </div>
                    <div class="field">
                        <label for="" class="label">Email</label>
                        <div class="control has-icons-left">
                            <input type="email" placeholder="e.g. xxx@gmail.com" class="input" required v-model="form.email">
                            <span class="icon is-small is-left">
                            <i class="fa fa-envelope"></i>
                            </span>
                        </div>
                    </div>
                    <div class="field">
                        <label for="" class="label">Username</label>
                        <div class="control has-icons-left">
                            <input type="text" placeholder="e.g. a3824b1" class="input" required v-model="form.username">
                            <span class="icon is-small is-left">
                                <i class="fas fa-info-circle"></i>
                            </span>
                        </div>
                    </div>
                    <div class="field">
                        <label for="" class="label">Password</label>
                        <div class="control has-icons-left">
                            <input type="password" placeholder="*******" class="input" required v-model="form.password">
                            <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                            </span>
                        </div>
                    </div>
                    <div class="field">
                        <button class="button is-success" @click.prevent="saveForm()">
                            Register
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
                    name: '',
                    email: '',
                    username: '',
                    password: ''
                },
                errors:[]
            }
        },
        methods: {
            saveForm() {
                axios.post('/api/register', this.form).then(() =>{
                    console.log('Your information has been successfully saved!');
                }).catch((error) =>{
                    this.errors = error.response.data.errors;
                })
            }
        }
    }
</script>