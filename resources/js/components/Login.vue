<template>
    <form @submit.prevent="submitForm">
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
                       name="password"
                       v-model="form.password"
                       :class="{'is-invalid' : form.errors.has('password')}">

                <span class="invalid-feedback" role="alert" v-if="form.errors.has('password')">
                    <strong v-text="form.errors.first('password')"></strong>
                </span>

            </div>
        </div>
        <div class="form-group row">
            <label for="verify_code"
                   class="col-md-4 col-form-label text-md-right">Verify Code</label>

            <div class="col-md-6">
                <div style="display: flex;">
                    <input id="verify_code"
                           type="text"
                           name="verify_code"
                           v-model="form.verify_code"
                           :class="{'is-invalid' : form.errors.has('verify_code')}"
                           class="form-control w-50">
                    <Captcha src="/captcha/api/login" ref="captcha" @captcha-updated="captchaUpdated"></Captcha>
                </div>
                <span class="invalid-feedback" role="alert" v-if="form.errors.has('verify_code')">
                    <strong v-text="form.errors.first('verify_code')"></strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" v-model="form.remember" type="checkbox" name="remember" id="remember">

                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
            </div>
        </div>


        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Login
                </button>


                <a class="btn btn-link" :href="resetPassword">
                    Forgot Your Password?
                </a>

            </div>
        </div>
    </form>
</template>
<script>
    import Captcha from './Captcha.vue';
    import Form from 'form-backend-validation';
    export default {
        props: ['reset-password'],
        components: {
            Captcha,
        },
        data() {
            return {
                form: new Form({
                    type: 'ajax',
                    phone: '',
                    password: '',
                    remember: false,
                    verify_code: '',
                    verify_code_key: '',
                })
            }
        },
        methods: {
            captchaUpdated(image) {
                this.form.verify_code_key = image.key;
            },
            submitForm() {
                console.log(this.$attrs.action);
                this.form.post(this.$attrs.action)
                    .then(e => {
                        window.location.href = '/home';
                    })
                    .catch((error) => {
                        this.refreshCaptcha();
                    });
            },
            refreshCaptcha() {
                if(this.form.errors.has('verify_code')) {
                    this.$refs.captcha.fetchData();
                }
            }
        }
    }
</script>
