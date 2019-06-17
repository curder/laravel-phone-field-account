<template>
    <form @submit.prevent="submitForm">
        <div class="form-group row">
            <label for="phone"
                   class="col-md-4 col-form-label text-md-right">Phone Number</label>

            <div class="col-md-6">
                <input id="phone"
                       type="text"
                       class="form-control"
                       v-model="form.phone"
                       :class="{'is-invalid' : form.errors.has('phone')}"
                       name="phone">
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

        <div class="form-group row">
            <label for="verify_code"
                   class="col-md-4 col-form-label text-md-right">Verify Code</label>

            <div class="col-md-6">
                <div style="display: flex;" class="input-group">
                    <input id="verify_code" type="text"
                           class="form-control w-50"
                           :class="{'is-invalid' : form.errors.has('password')}"
                           v-model="form.verify_code"
                           name="verify_code">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="sendRegisterVerifySmsButton">点击获取验证码</button>
                    </div>
                </div>

                <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('verify_code')">
                    <strong v-text="form.errors.first('verify_code')"></strong>
                </span>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Register
                </button>
            </div>
        </div>
    </form>
</template>
<script>
    import Form from 'form-backend-validation';

    export default {
        data() {
            return {
                form: new Form({
                    phone: '',
                    password: '',
                    password_confirmation: '',
                    verify_code: '',
                }),
            }
        },
        methods: {
            submitForm() {
                this.form.post(this.$attrs.action).then((data) => {
                    window.location.href = '/home';
                }).catch((data) => {console.log(data)});
            }
        }
    }
</script>
