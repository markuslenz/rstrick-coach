import { createI18n } from 'vue-i18n'

export default (page) => {
    const i18n = createI18n({
        legacy: false,
        locale: page.props.locale,
        fallbackLocale: 'en',
        messages: page.props.translations,
    })

    return i18n
}