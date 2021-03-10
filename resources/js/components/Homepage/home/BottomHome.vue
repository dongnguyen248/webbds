<template>
<div class="containerSignUp w-clear " v-bind:style="{ backgroundImage: 'url(images/bacground1.jpg)' }">
    <div class="center">
        <div class="boxSignUp">
            <div class="infoSignUp">
                <p>Nếu quý khách hàng đang cần tư vấn hỗ trợ thông tin xin hãy để lại thông tin ở Form bên cạnh để chúng tôi liên hệ tư vấn trực tiếp cho quý khách hàng !</p>
                <p>Điện thoại: <span>0937.967.589</span> </p>
                <p>Để lại địa chỉ email của bạn để nhận thông tin mới nhất từ chúng tôi</p>
                <div class="box_icon w-clear">
                </div>
            </div>
            <div class="contentSignUp">
                <form method="post" name="nhanemail" id="nhanemail" @submit="sendMail()">
                    <div class="dangkynt">
                        <div class="tit-dk w-clear">
                            <input type="text" v-model="form.name" placeholder="Họ tên">
                        </div>
                        <div class="tit-dk w-clear">
                            <input type="text" v-model="form.email" placeholder="Email">
                        </div>
                        <div class="tit-dk w-clear">
                            <input type="text" v-model="form.phone" placeholder="Điện thoại">
                        </div>
                        <div class="btnsent">
                            <input type="submit" class="sentdk" value="Gửi">
                        </div>
                    </div>
                    <input type="hidden" name="command">
                    <div class="clear"></div>
                </form>
            </div>
        </div>

    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            form: new Form({
                name: "",
                email: "",
                phone: " "
            })
        }
    },
    methods: {
        sendMail() {
            const formData = new FormData();
            formData.set("name", this.name);
            formData.set("email", this.form.email);
            formData.set("phone", this.form.phone);
            axios.post('sendmail', formData).then(response => {
                this.customer.name = ''
                this.customer.email = ''
                this.customer.message = ''
            })

        },
    }

}
</script>

<style scoped>
.containerSignUp {
    /* background: url() no-repeat; */
    background-position-x: 0%;
    background-position-y: 0%;
    background-attachment: scroll;
    background-size: auto;
    background-attachment: fixed;
    background-position: center;
    background-size: cover;
}

.containerSignUp {
    padding: 75px 0px;
    background-size: 100% 100%;
}

.center {
    max-width: 1200px;
    margin: 0px auto;
}

.boxSignUp {
    background: rgba(0, 0, 0, 0.5);
    min-height: 300px;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-flow: row wrap;
}

.infoSignUp {
    width: 70%;
    text-align: center;
    color: #fff;
    font-family: Tahoma;
    font-size: 17px;
}

.infoSignUp p:first-of-type {
    font-size: 24px;
    text-transform: uppercase;
    font-family: 'SFUFuturaBold';
}

.infoSignUp p {
    margin-bottom: 20px;
}

p {
    line-height: 25px;
}

.infoSignUp p:nth-of-type(2) {
    text-transform: uppercase;
}

.box_icon {
    margin-top: 10px;
    text-align: center;
}

.contentSignUp {
    width: 30%;
    padding: 20px;
    border-left: 1px solid #888888;
}

.tit-dk {
    margin-bottom: 10px;
}

.clear {
    clear: both;
}
</style>
