<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property array $title
 * @property string $slug
 * @property array|null $description
 * @property string|null $cover_image
 * @property bool $is_published
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int $photo_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AlbumPhoto> $photos
 * @property-read int|null $photos_count
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Album newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Album newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Album published()
 * @method static \Illuminate\Database\Eloquent\Builder|Album query()
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereCoverImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereUpdatedAt($value)
 */
	class Album extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $album_id
 * @property string $image_path
 * @property array|null $caption
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Album $album
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumPhoto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumPhoto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumPhoto query()
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumPhoto whereAlbumId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumPhoto whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumPhoto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumPhoto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumPhoto whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumPhoto whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumPhoto whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumPhoto whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumPhoto whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumPhoto whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumPhoto whereUpdatedAt($value)
 */
	class AlbumPhoto extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $category_id
 * @property array $title
 * @property string|null $slug
 * @property array|null $excerpt
 * @property array $body
 * @property string|null $featured_image
 * @property bool $is_published
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property int $view_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id
 * @property string|null $author_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read mixed $translations
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Article latestPublished()
 * @method static \Illuminate\Database\Eloquent\Builder|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article published()
 * @method static \Illuminate\Database\Eloquent\Builder|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereAuthorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereFeaturedImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Article wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereViewCount($value)
 */
	class Article extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property array $name
 * @property string $slug
 * @property string|null $icon
 * @property string $type
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Article> $articles
 * @property-read int|null $articles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Program> $programs
 * @property-read int|null $programs_count
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Category articleType()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category programType()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $message
 * @property bool $is_read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message unread()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 */
	class Message extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $category_id
 * @property array $title
 * @property string $slug
 * @property array|null $excerpt
 * @property array $body
 * @property string|null $featured_image
 * @property string|null $video_url
 * @property string|null $pdf_file
 * @property bool $is_published
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property int $sort_order
 * @property string $status
 * @property int $view_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id
 * @property string|null $author_name
 * @property int $human_capital
 * @property int $social_capital
 * @property int $natural_capital
 * @property int $physical_capital
 * @property int $financial_capital
 * @property string|null $human_capital_note
 * @property string|null $social_capital_note
 * @property string|null $natural_capital_note
 * @property string|null $physical_capital_note
 * @property string|null $financial_capital_note
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read string $status_color
 * @property-read string $status_label
 * @property-read mixed $translations
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Program completed()
 * @method static \Illuminate\Database\Eloquent\Builder|Program newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Program newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Program ongoing()
 * @method static \Illuminate\Database\Eloquent\Builder|Program published()
 * @method static \Illuminate\Database\Eloquent\Builder|Program query()
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereAuthorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereFeaturedImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereFinancialCapital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereFinancialCapitalNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereHumanCapital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereHumanCapitalNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereNaturalCapital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereNaturalCapitalNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program wherePdfFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program wherePhysicalCapital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program wherePhysicalCapitalNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereSocialCapital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereSocialCapitalNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereVideoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereViewCount($value)
 */
	class Program extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property array $name
 * @property array $role
 * @property array|null $description
 * @property string|null $photo
 * @property string $type
 * @property string|null $gender
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereUpdatedAt($value)
 */
	class TeamMember extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $role
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

