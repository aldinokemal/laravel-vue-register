<template>
    <div style="position: relative; min-height: 100%;">
        <div class="ui container" style="padding-bottom: 107px;">
            <br>
            <form class="ui form">
                <div class="ui negative message" v-show="errors.length > 0">
                    <li v-for="e in errors">
                        {{ e }}
                    </li>
                </div>
                <h2 :class="{'ui':true, 'dividing': true, 'header': true, 'disabled': isRegister}">Registration</h2>
                <div :class="{'field': true, 'disabled': isRegister, 'error': errorPhone}" data-inverted
                     data-tooltip="Please enter valid Indonesian phone number" data-position="top center">
                    <!-- <label>Mobile Number</label> -->
                    <input type="text" placeholder="Mobile Number" v-model="phone">
                </div>
                <div :class="{'field': true, 'disabled': isRegister, 'error': errorFname}">
                    <!-- <label>First Name</label> -->
                    <input type="text" placeholder="First Name" v-model="fname">
                </div>
                <div :class="{'field': true, 'disabled': isRegister, 'error': errorLname}">
                    <!-- <label>Last Name</label> -->
                    <input type="text" placeholder="Last Name" v-model="lname">
                </div>
                <div :class="{'three': true, 'fields': true, 'disabled': isRegister}">
                    <div class="field">
                        <!-- <label>Month</label> -->
                        <select class="ui fluid dropdown" id="month">
                            <option selected disabled>Month</option>
                            <option v-for="m in months" :key="m.id" :value="m.id">{{ m.name }}</option>
                        </select>
                    </div>
                    <div class="field">
                        <!-- <label>Date</label> -->
                        <select class="ui fluid dropdown" id="date">
                            <option selected disabled>Date</option>
                            <template v-for="d in 31">
                                <option v-if="d < 10">
                                    0{{ d }}
                                </option>
                                <option v-else>
                                    {{ d }}
                            </option>
                            </template>
                        </select>
                    </div>
                    <div class="field">
                        <!-- <label>Year</label> -->
                        <select class="ui fluid dropdown" id="year">
                            <option selected disabled>Year</option>
                            <option v-for="y in years">{{ y }}</option>

                        </select>
                    </div>
                </div>

                <div :class="{'inline': true, 'fields': true, 'disabled': isRegister}">
                    <!-- <label for="fruit">Gender</label> -->
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" v-model="gender" value="male">
                            <label>Male</label>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" v-model="gender" value="female">
                            <label>Female</label>
                        </div>
                    </div>
                </div>
                <div :class="{'field': true, 'disabled': isRegister, 'error': errorEmail}">
                    <!-- <label>Email</label> -->
                    <input type="text" placeholder="Email" v-model="email">
                </div>

                <div :class="{'fluid': true, 'ui':true, 'button':true, 'purple':true, 'disabled': isRegister}"
                     @click="processRegister()">
                    Register
                </div>
            </form>
        </div>

        <!-- <br v-for="n in 100"> -->
        <div :class="{'footer': true, 'disabledfooter': isRegister}">
            <div class="ui container">
                <br>
                <template v-if="isRegister">
                    <div style="padding: 16px">
                    <button class="fluid ui button purple" @click="goLogin">Login</button>
                    </div>
                </template>
                <template v-else>
                    <h2>FOOTER</h2>
                </template>
                <br>
            </div>
        </div>


    </div>

</template>

<script>
    export default {
        data() {
            return {
                errors: [],
                months: [],
                years: _.range(1945, 2020),
                isRegister: false,

                //validation
                errorPhone: false,
                errorFname: false,
                errorLname: false,
                errorEmail: false,

                //register
                phone: '',
                gender: '',
                email: '',
                fname: '',
                lname: '',
                birthday: '',
            }
        },
        created() {
            this.getMonth();
        },
        methods: {
            getMonth() {
                axios.get(`${BASEURL}/get/month`)
                    .then(response => {
                        this.months = response.data.result;
                    })
            },
            resetError() {
                this.errors = [];
                this.errorPhone = false;
                this.errorFname = false;
                this.errorLname = false;
                this.errorEmail = false;
            },
            goLogin() {
                window.location.href = BASEURL + '/login';
            },
            processValidation() {
                this.resetError();
                if (!(_.startsWith(this.phone, '+62', 0))) {
                    this.errorPhone = true;
                    this.errors.push('Insert indonesian number format start with +62');
                }
                if (this.fname == "") {
                    this.errorFname = true;
                    this.errors.push('First name is required');
                }
                if (this.lname == "") {
                    this.errorLname = true;
                    this.errors.push('Last name is required');
                }
                if (this.email == "") {
                    this.errorEmail = true;
                    this.errors.push('Email is required');
                }

                if (this.errors.length == 0) {
                    return true
                } else {
                    return false;
                }
            },
            processRegister() {
                
                let validation = this.processValidation();
                if (validation) {
                    let formData = {
                        phone: this.phone,
                        email: this.email,
                        fname: this.fname,
                        lname: this.lname,
                        gender: this.gender,
                        date: $("#month").val(),
                        month: $("#date").val(),
                        year: $("#year").val(),

                    }
                    axios.post(`${BASEURL}/register`, formData)
                        .then(response => {
                            this.isRegister = true;
                        })
                        .catch(e => {
                            this.isRegister = false;
                            this.errors.push(e.response.data.message);
                        })
                }
            }
        }
    }
</script>

<style>
    .footer {
        position: absolute;
        width: 100%;
        color: white;
        background-color: #B100C9;
        text-align: center;
    }

    .disabledfooter {
        background-color: #C284CB;
        color: #DADADA;
    }
</style>
