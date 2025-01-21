import { createI18n } from "vue-i18n";
import EN from "./EN.json";
import DARI from "./DARI.json";
const messages = {
    en: EN,
    fa: DARI,

};

const i18n = createI18n({
    legacy: false, 
    locale: "en", 
    fallbackLocale: "en",
    messages,
});

export default i18n;
