<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locales')->insert([
            [
                'code'        => 'en',
                'title'       => 'English',
                'direction'   => 'LTR',
                'status'      => 1,
                'native_name' => null
            ],
            [
                'code'        => 'ar',
                'title'       => 'Arabic',
                'direction'   => 'RTL',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ab',
                'title'       => 'Abkhaz',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'aa',
                'title'       => 'Afar',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'af',
                'title'       => 'Afrikaans',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ak',
                'title'       => 'Akan',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'sq',
                'title'       => 'Albanian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'am',
                'title'       => 'Amharic',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'an',
                'title'       => 'Aragonese',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'hy',
                'title'       => 'Armenian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'as',
                'title'       => 'Assamese',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'av',
                'title'       => 'Avaric',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ae',
                'title'       => 'Avestan',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ay',
                'title'       => 'Aymara',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'az',
                'title'       => 'Azerbaijani',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'bm',
                'title'       => 'Bambara',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ba',
                'title'       => 'Bashkir',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'eu',
                'title'       => 'Basque',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'be',
                'title'       => 'Belarusian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'bn',
                'title'       => 'Bengali',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'bh',
                'title'       => 'Bihari',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'bi',
                'title'       => 'Bislama',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'bs',
                'title'       => 'Bosnian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'br',
                'title'       => 'Breton',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'bg',
                'title'       => 'Bulgarian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'my',
                'title'       => 'Burmese',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ca',
                'title'       => 'Catalan; Valencian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ch',
                'title'       => 'Chamorro',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ce',
                'title'       => 'Chechen',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ny',
                'title'       => 'Chichewa; Chewa; Nyanja',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'zh',
                'title'       => 'Chinese',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'cv',
                'title'       => 'Chuvash',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'kw',
                'title'       => 'Cornish',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'co',
                'title'       => 'Corsican',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'cr',
                'title'       => 'Cree',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'hr',
                'title'       => 'Croatian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'cs',
                'title'       => 'Czech',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'da',
                'title'       => 'Danish',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'dv',
                'title'       => 'Divehi; Dhivehi; Maldivian;',
                'direction'   => 'RTL',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'nl',
                'title'       => 'Dutch',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'eo',
                'title'       => 'Esperanto',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'et',
                'title'       => 'Estonian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ee',
                'title'       => 'Ewe',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'fo',
                'title'       => 'Faroese',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'fj',
                'title'       => 'Fijian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'fi',
                'title'       => 'Finnish',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'fr',
                'title'       => 'French',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ff',
                'title'       => 'Fula; Fulah; Pulaar; Pular',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'gl',
                'title'       => 'Galician',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ka',
                'title'       => 'Georgian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'de',
                'title'       => 'German',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'el',
                'title'       => 'Greek, Modern',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'gn',
                'title'       => 'Guaraní',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'gu',
                'title'       => 'Gujarati',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ht',
                'title'       => 'Haitian; Haitian Creole',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ha',
                'title'       => 'Hausa',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'he',
                'title'       => 'Hebrew (modern)',
                'direction'   => 'RTL',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'hz',
                'title'       => 'Herero',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'hi',
                'title'       => 'Hindi',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ho',
                'title'       => 'Hiri Motu',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'hu',
                'title'       => 'Hungarian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ia',
                'title'       => 'Interlingua',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'id',
                'title'       => 'Indonesian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ie',
                'title'       => 'Interlingue',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ga',
                'title'       => 'Irish',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ig',
                'title'       => 'Igbo',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ik',
                'title'       => 'Inupiaq',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'io',
                'title'       => 'Ido',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'is',
                'title'       => 'Icelandic',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'it',
                'title'       => 'Italian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'iu',
                'title'       => 'Inuktitut',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ja',
                'title'       => 'Japanese',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'jv',
                'title'       => 'Javanese',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'kl',
                'title'       => 'Kalaallisut, Greenlandic',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'kn',
                'title'       => 'Kannada',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'kr',
                'title'       => 'Kanuri',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ks',
                'title'       => 'Kashmiri',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'kk',
                'title'       => 'Kazakh',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'km',
                'title'       => 'Khmer',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ki',
                'title'       => 'Kikuyu, Gikuyu',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'rw',
                'title'       => 'Kinyarwanda',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ky',
                'title'       => 'Kirghiz, Kyrgyz',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'kv',
                'title'       => 'Komi',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'kg',
                'title'       => 'Kongo',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ko',
                'title'       => 'Korean',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ku',
                'title'       => 'Kurdish',
                'direction'   => 'RTL',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'kj',
                'title'       => 'Kwanyama, Kuanyama',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'la',
                'title'       => 'Latin',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'lb',
                'title'       => 'Luxembourgish, Letzeburgesch',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'lg',
                'title'       => 'Luganda',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'li',
                'title'       => 'Limburgish, Limburgan, Limburger',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ln',
                'title'       => 'Lingala',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'lo',
                'title'       => 'Lao',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'lt',
                'title'       => 'Lithuanian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'lu',
                'title'       => 'Luba-Katanga',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'lv',
                'title'       => 'Latvian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'gv',
                'title'       => 'Manx',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'mk',
                'title'       => 'Macedonian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'mg',
                'title'       => 'Malagasy',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ms',
                'title'       => 'Malay',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ml',
                'title'       => 'Malayalam',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'mt',
                'title'       => 'Maltese',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'mi',
                'title'       => 'Māori',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'mr',
                'title'       => 'Marathi (Marāṭhī)',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'mh',
                'title'       => 'Marshallese',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'mn',
                'title'       => 'Mongolian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'na',
                'title'       => 'Nauru',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'nv',
                'title'       => 'Navajo, Navaho',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'nb',
                'title'       => 'Norwegian Bokmål',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'nd',
                'title'       => 'North Ndebele',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ne',
                'title'       => 'Nepali',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ng',
                'title'       => 'Ndonga',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'nn',
                'title'       => 'Norwegian Nynorsk',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'no',
                'title'       => 'Norwegian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ii',
                'title'       => 'Nuosu',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'nr',
                'title'       => 'South Ndebele',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'oc',
                'title'       => 'Occitan',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'oj',
                'title'       => 'Ojibwe, Ojibwa',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'cu',
                'title'       => 'Old Church Slavonic, Church Slavic, Church Slavonic, Old Bulgarian, Old Slavonic',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'om',
                'title'       => 'Oromo',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'or',
                'title'       => 'Oriya',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'os',
                'title'       => 'Ossetian, Ossetic',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'pa',
                'title'       => 'Panjabi, Punjabi',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'pi',
                'title'       => 'Pāli',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'fa',
                'title'       => 'Persian',
                'direction'   => 'RTL',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'pl',
                'title'       => 'Polish',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ps',
                'title'       => 'Pashto, Pushto',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'pt',
                'title'       => 'Portuguese',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'qu',
                'title'       => 'Quechua',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'rm',
                'title'       => 'Romansh',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'rn',
                'title'       => 'Kirundi',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ro',
                'title'       => 'Romanian, Moldavian, Moldovan',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ru',
                'title'       => 'Russian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'sa',
                'title'       => 'Sanskrit (Saṁskṛta)',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'sc',
                'title'       => 'Sardinian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'sd',
                'title'       => 'Sindhi',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'se',
                'title'       => 'Northern Sami',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'sm',
                'title'       => 'Samoan',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'sg',
                'title'       => 'Sango',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'sr',
                'title'       => 'Serbian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'gd',
                'title'       => 'Scottish Gaelic; Gaelic',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'sn',
                'title'       => 'Shona',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'si',
                'title'       => 'Sinhala, Sinhalese',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'sk',
                'title'       => 'Slovak',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'sl',
                'title'       => 'Slovene',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'so',
                'title'       => 'Somali',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'st',
                'title'       => 'Southern Sotho',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'es',
                'title'       => 'Spanish; Castilian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'su',
                'title'       => 'Sundanese',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'sw',
                'title'       => 'Swahili',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ss',
                'title'       => 'Swati',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'sv',
                'title'       => 'Swedish',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ta',
                'title'       => 'Tamil',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'te',
                'title'       => 'Telugu',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'tg',
                'title'       => 'Tajik',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'th',
                'title'       => 'Thai',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ti',
                'title'       => 'Tigrinya',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'bo',
                'title'       => 'Tibetan Standard, Tibetan, Central',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'tk',
                'title'       => 'Turkmen',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'tl',
                'title'       => 'Tagalog',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'tn',
                'title'       => 'Tswana',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'to',
                'title'       => 'Tonga (Tonga Islands)',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'tr',
                'title'       => 'Turkish',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ts',
                'title'       => 'Tsonga',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'tt',
                'title'       => 'Tatar',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'tw',
                'title'       => 'Twi',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ty',
                'title'       => 'Tahitian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ug',
                'title'       => 'Uighur, Uyghur',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'uk',
                'title'       => 'Ukrainian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'ur',
                'title'       => 'Urdu',
                'direction'   => 'RTL',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'uz',
                'title'       => 'Uzbek',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 've',
                'title'       => 'Venda',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'vi',
                'title'       => 'Viettitlese',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'vo',
                'title'       => 'Volapük',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'wa',
                'title'       => 'Walloon',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'cy',
                'title'       => 'Welsh',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'wo',
                'title'       => 'Wolof',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'fy',
                'title'       => 'Western Frisian',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'xh',
                'title'       => 'Xhosa',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'yi',
                'title'       => 'Yiddish',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'yo',
                'title'       => 'Yoruba',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ],
            [
                'code'        => 'za',
                'title'       => 'Zhuang, Chuang',
                'direction'   => 'LTR',
                'status'      => 0,
                'native_name' => null
            ]
        ]);
    }
}