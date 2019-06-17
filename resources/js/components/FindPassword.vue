<template>
    <form @submit.prevent="submitForm">
        <div class="form-group row">
            <label for="phone"
                   class="col-md-4 col-form-label text-md-right">Phone Number</label>

            <div class="col-md-6">
                <input id="phone" type="text"
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
            <label for="verify_code"
                   class="col-md-4 col-form-label text-md-right">Verify Code</label>

            <div class="col-md-6">
                <div style="display: flex;" class="input-group">
                    <input id="verify_code" type="text"
                           class="form-control w-50"
                           name="verify_code"
                           v-model="form.verify_code"
                           :class="{'is-invalid' : form.errors.has('verify_code')}"
                    >
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="sendResetVerifySmsButton">点击获取验证码</button>
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
                    Password Reset
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
                    verify_code: '',
                }),
            }
        },
        methods: {
            submitForm() {
                this.form.post(this.$attrs.action)
                    .then(({redirect}) => {
                        window.location.href = redirect;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        }
    }
</script>
