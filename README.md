# Post Types Personalizados
Carregue o este repositório no seu código e utilize o método:

```
/*
 * Register The Custom Post Type.
 *
 * @param string $post_type The post type slug.
 * @param string $singular_name The post type singular name.
 * @param string $pluram_name The post stype plural name.
 * @param string $gender The post type word gender.
 * @param array<string, mixed> $custom_labels The array with $labels properties. See WordPress doc for array keys.
 * @param array<string, mixed> $custom_args The array with $args properties. See WordPress doc for array keys.
 */
function register_custom_post_type(
	string $post_type,
	string $singular_name,
	string $plural_name,
	string $gender = 'M',
	array $custom_labels = array(),
	array $custom_args = array()
): void 
```
