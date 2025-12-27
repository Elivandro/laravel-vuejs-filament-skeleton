<template>
    <section class="text-gray-600 mx-auto max-w-lg">
        <div class="container px-5 mx-auto flex flex-wrap">
            <form @submit.prevent="save" class="bg-white flex flex-col w-full">

                <h1 class="text-3xl mb-4 font-medium title-font text-green-600 text-center">
                    Formulário de contato
                </h1>

                <p v-if="feedback" class="text-green-600 text-center">
                    {{ feedback }}
                </p>

                <p v-if="error" class="text-red-600 text-center">
                    {{ error }}
                </p>

                <div class="relative mb-4">
                    <label for="name" class="leading-7 text-sm text-gray-600">
                        Name
                    </label>
                    <input v-model="form.name" type="text" id="name"
                        class="w-full bg-white rounded border border-gray-300 py-1 px-3" />
                </div>

                <div class="relative mb-4">
                    <label for="email" class="leading-7 text-sm text-gray-600">
                        Email
                    </label>
                    <input v-model="form.email" type="email" id="email"
                        class="w-full bg-white rounded border border-gray-300 py-1 px-3" />
                </div>

                <div class="relative mb-4">
                    <label for="message" class="leading-7 text-sm text-gray-600">
                        Message
                    </label>
                    <textarea v-model="form.message" id="message"
                        class="w-full bg-white rounded border border-gray-300 h-32 py-1 px-3 resize-none">
                    </textarea>
                </div>

                <button type="submit" class="text-white bg-green-500 py-2 px-6 hover:bg-green-600 rounded text-lg">
                    Enviar
                </button>
            </form>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            form: {
                name: null,
                email: null,
                message: null,
            },
            feedback: null,
            error: null,
        };
    },
    methods: {
        showFeedback(message, duration = 5000) {
            this.feedback = message;

            setTimeout(() => {
                this.feedback = null;
            }, duration);
        },

        showError(message, duration = 5000) {
            this.error = message;

            setTimeout(() => {
                this.error = null;
            }, duration);
        },

        async save() {
            this.feedback = null;
            this.error = null;

            try {
                const response = await axios.post('contact', this.form);

                this.showFeedback(response.data.success);

                this.form = {
                    name: null,
                    email: null,
                    message: null,
                };
            } catch (err) {
                this.showError(
                    err.response?.data?.error ?? 'Erro ao enviar mensagem.'
                );
            }
        },
    },
};

</script>
