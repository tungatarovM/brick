<template>
  <div class="auth__wrapper">
    <div class="auth__header">
      <h2 class="auth__logo heading__two">
        Brick
      </h2>
    </div>
    <div class="auth__inner">
      <form class="auth__box">
        <h3 class="heading__third text-center">
          Войти
        </h3>
        <div class="form-group">
          <label>Email</label>
          <input
            v-model="email"
            type="email" class="form-control"
            placeholder="Введите ваш email">
          <input-error :error="error.email"></input-error>
        </div>
        <div class="form-group">
          <label>Пароль</label>
          <input
            v-model="password"
            type="password" class="form-control"
            placeholder="Введите ваш пароль">
          <input-error :error="error.password"></input-error>
        </div>
        <div class="form-check form-group">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Запомнить</label>
        </div>
        <div class="form-group">
          <button @click="submit" class="btn btn-success w-100">
            Войти
          </button>
        </div>
        <div class="form-group auth__actions">
          <button class="btn btn-link">Забыли пароль?</button>
          <button class="btn btn-link">Зарегистроваться</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import InputError from "../../../../common/components/Form/InputError";
import Validator from "../../../../common/mixins/Form/Validator";
import AuthHandlers from "../../../../common/mixins/Auth/Handlers";

export default {
  name: "Index.vue",
  components: {
    InputError
  },
  mixins: [
    Validator, AuthHandlers,
  ],
  data: () => ({
    email: '',
    password: '',
    error: {
      email: '',
      password: '',
    }
  }),
  methods: {
    submit() {
      // validation
      const { attributes, errors, isValid } = this.validate({
        email: 'required',
        password: 'required',
      });

      this.error = {
        ...this.error,
        ...errors,
      };

      if (!isValid) return;

      this.login(attributes.email, attributes.password);
    }
  }
}
</script>
