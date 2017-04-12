import algolia from 'algoliasearch'
import autocomplete from 'autocomplete.js'

var index = algolia('50IB1ZGMK1', '80dda974625b4481d740a6f403506f85')

export const userautocomplete = selector => {
    var users = index.initIndex('users')

    return autocomplete(selector, {}, {
        source: autocomplete.sources.hits(users, { hitsPerPage: 10 }),
        displayKey: 'name',
        templates: {
            suggestion (suggestion) {
                return '<span>' + suggestion.name + '</span>'
            },
            empty: '<div class="aa-empty">No people found.</div>'
        }
    })
}
