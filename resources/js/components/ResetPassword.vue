<template>
    <form method="POST" @submit.prevent="submitForm">
        <div class="form-group row">
            <label for="phone"
                   class="col-md-4 col-form-label text-md-right">Phone Number</label>

            <div class="col-md-6">
                <input id="phone"
                       type="text"
                       class="form-control"
                       name="phone"
                       v-model="form.phone"
                       :class="{'is-invalid' : form.errors.has('phone')}"
                       autofocus>
                <span class="invalid-feedback" role="alert" v-if="form.errors.has('phone')">
                    <strong v-text="form.errors.first('phone')"></strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <label for="password"
                   class="col-md-4 col-form-label text-md-right">Password</label>

            <div class="col-md-6">
                <input id="password"
                       type="password"
                       class="form-control"
                       v-model="form.password"
                       :class="{'is-invalid' : form.errors.has('password')}"
                       name="password">
                <span class="invalid-feedback" role="alert" v-if="form.errors.has('password')">
                    <strong v-text="form.errors.first('password')"></strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm"
                   class="col-md-4 col-form-label text-md-right">Confirm Password</label>

            <div class="col-md-6">
                <input id="password-confirm"
                       type="password"
                       class="form-control"
                       v-model="form.password_confirmation"
                       name="password_confirmation">
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Reset Password
                </button>
            </div>
        </div>
    </form>
</template>
<script>
    import Form from 'form-backend-validation';

    export default {
        props: ['token'],
        data() {
            return {
                form: new Form({
                    phone: '',
                    password: '',
                    password_confirmation: '',
                    token: this.token
                }),
            }
        },
        methods: {
            submitForm() {
                this.form.post(this.$attrs.action)
                    .then((data) => {
                    window.location.href = '/home';
                }).catch((data) => {console.log(data)});
            }
        }
    }
</script>
