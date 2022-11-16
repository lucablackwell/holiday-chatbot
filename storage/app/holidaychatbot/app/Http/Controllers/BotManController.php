<?php
namespace App\Http\Controllers;

use App\Models\Holiday;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Cache\LaravelCache;
use BotMan\BotMan\Cache\SymfonyCache;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class BotManController extends Controller
{
    protected $user_name;
    protected $user_want;

    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

//        $botman = BotManFactory::create([
//            'config' => [
//                'user_cache_time' => 30000,
//                'conversation_cache_time' => 30000,
//            ],
//        ], new LaravelCache());
//
//        $adapter = new FilesystemAdapter();
//        $botman = BotManFactory::create([
//            'config' => [
//                'user_cache_time' => 30000,
//                'conversation_cache_time' => 30000,
//            ],
//        ], new SymfonyCache($adapter));
//
//        $botman->hears('{message}', function($botman, $message) {
//            $botman->startConversation(new HolidayConversation);
//        });

        $botman->hears('{message}', function($botman, $message) {
            $this->conversation($botman);

        });
//        $botman->ask('Hello! What is your name?', function(Answer $answer) {
//
//            $this->user_name = $answer->getText();
//            $this->reply('It\'s lovely to meet you, ' . $this->user_name . '. Let\'s find you a holiday!');
//
//            //$this->askCountry($this);
//        });
        $botman->listen();

    }

    /**
     * Place your BotMan logic here.
     */
    public function conversation($botman)
    {
        $botman->ask('Hello! What is your name?', function(Answer $answer) {
            $this->user_name = $answer->getText();
            $this->say('It\'s lovely to meet you, ' . $this->user_name . '. Let\'s find you a holiday!');

            $this->ask('What country do you live in, ' . $this->user_name . '?', function(Answer $answer) {
                $this->user_want['country'] = strtoupper($answer->getText());
                $countries = ['AFGHANISTAN', 'ALBANIA', 'ALGERIA', 'ANDORRA', 'ANGOLA', 'ANTIGUA & DEPS', 'ARGENTINA', 'ARMENIA', 'AUSTRALIA', 'AUSTRIA', 'AZERBAIJAN', 'BAHAMAS', 'BAHRAIN', 'BANGLADESH', 'BARBADOS', 'BELARUS', 'BELGIUM', 'BELIZE', 'BENIN', 'BHUTAN', 'BOLIVIA', 'BOSNIA HERZEGOVINA', 'BOTSWANA', 'BRAZIL', 'BRUNEI', 'BULGARIA', 'BURKINA', 'BURUNDI', 'CAMBODIA', 'CAMEROON', 'CANADA', 'CAPE VERDE', 'CENTRAL AFRICAN REP', 'CHAD', 'CHILE', 'CHINA', 'COLOMBIA', 'COMOROS', 'CONGO', 'COSTA RICA', 'CROATIA', 'CUBA', 'CYPRUS', 'CZECH REPUBLIC', 'DENMARK', 'DJIBOUTI', 'DOMINICA', 'DOMINICAN REPUBLIC', 'EAST TIMOR', 'ECUADOR', 'EGYPT', 'EL SALVADOR', 'EQUATORIAL GUINEA', 'ERITREA', 'ESTONIA', 'ETHIOPIA', 'FIJI', 'FINLAND', 'FRANCE', 'FRENCH POLYNESIA', 'GABON', 'GAMBIA', 'GEORGIA', 'GERMANY', 'GHANA', 'GREECE', 'GRENADA', 'GUATEMALA', 'GUINEA', 'GUINEA-BISSAU', 'GUYANA', 'HAITI', 'HONDURAS', 'HUNGARY', 'ICELAND', 'INDIA', 'INDONESIA', 'IRAN', 'IRAQ', 'IRELAND {REPUBLIC}', 'ISRAEL', 'ITALY', 'IVORY COAST', 'JAMAICA', 'JAPAN', 'JORDAN', 'KAZAKHSTAN', 'KENYA', 'KIRIBATI', 'KOREA NORTH', 'KOREA SOUTH', 'KOSOVO', 'KUWAIT', 'KYRGYZSTAN', 'LAOS', 'LATVIA', 'LEBANON', 'LESOTHO', 'LIBERIA', 'LIBYA', 'LIECHTENSTEIN', 'LITHUANIA', 'LUXEMBOURG', 'MACEDONIA', 'MADAGASCAR', 'MALAWI', 'MALAYSIA', 'MALDIVES', 'MALI', 'MALTA', 'MARSHALL ISLANDS', 'MAURITANIA', 'MAURITIUS', 'MEXICO', 'MICRONESIA', 'MOLDOVA', 'MONACO', 'MONGOLIA', 'MONTENEGRO', 'MOROCCO', 'MOZAMBIQUE', 'MYANMAR, {BURMA}', 'NAMIBIA', 'NAURU', 'NEPAL', 'NETHERLANDS', 'NEW ZEALAND', 'NICARAGUA', 'NIGER', 'NIGERIA', 'NORWAY', 'OMAN', 'PAKISTAN', 'PALAU', 'PANAMA', 'PAPUA NEW GUINEA', 'PARAGUAY', 'PERU', 'PHILIPPINES', 'POLAND', 'PORTUGAL', 'QATAR', 'ROMANIA', 'RUSSIAN FEDERATION', 'RWANDA', 'ST KITTS & NEVIS', 'ST LUCIA', 'SAINT VINCENT & THE GRENADINES', 'SAMOA', 'SAN MARINO', 'SAO TOME & PRINCIPE', 'SAUDI ARABIA', 'SENEGAL', 'SERBIA', 'SEYCHELLES', 'SIERRA LEONE', 'SINGAPORE', 'SLOVAKIA', 'SLOVENIA', 'SOLOMON ISLANDS', 'SOMALIA', 'SOUTH AFRICA', 'SOUTH SUDAN', 'SPAIN', 'SRI LANKA', 'SUDAN', 'SURINAME', 'SWAZILAND', 'SWEDEN', 'SWITZERLAND', 'SYRIA', 'TAIWAN', 'TAJIKISTAN', 'TANZANIA', 'THAILAND', 'TOGO', 'TONGA', 'TRINIDAD & TOBAGO', 'TUNISIA', 'TURKEY', 'TURKMENISTAN', 'TUVALU', 'UGANDA', 'UKRAINE', 'UNITED ARAB EMIRATES', 'UNITED KINGDOM', 'UNITED STATES', 'UNITED STATES OF AMERICA', 'USA', 'URUGUAY', 'UZBEKISTAN', 'VANUATU', 'VATICAN CITY', 'VENEZUELA', 'VIETNAM', 'YEMEN', 'ZAMBIA', 'ZIMBABWE'];
                if (in_array($this->user_want['abroad']['country'], $countries)) {
                    $this->ask('Thank you. Do you want to go abroad? (y\n)', function(Answer $answer) {
                        if ($answer[0] == 'y') {
                            $this->user_want['abroad']['want'] = true;
                        } else {
                            $this->user_want['abroad']['want'] = false;
                        }
                        //$this->user_want['']
                                $this->say('I\'m sorry, but I don\'t know that country. Please check your spelling or choose the one closest.');
                    });
                } else {
                    // Country is invalid - can't use while loop so ask user to refresh
                    $this->say('I\'m sorry, but I don\'t know that country. Please check your spelling or choose the one closest, refresh and enter it again.');
//                    while (!in_array($this->user_want['country'], $countries)) {
//                        $this->say('bit odd innit');
//                    }
                }
            });
        });
    }

    function showHoliday($holiday, $botman) {
        $botman->say("Name: " . $holiday['HotelName'] . "\n");
        echo "PPN: " . $holiday['PricePerNight'] . "\n";
        echo "Located: " . $holiday['City'] . ", " . $holiday['Country'] . ", " . $holiday['Continent'] . "\n";
        echo "Surroundings: " . $holiday['Location'] . "\n";
        $stars = '';
        for ($i = 0; $i < $holiday['StarRating']; $i++) {
            $stars .= '★';
        }
        echo "Stars: " . $stars . "\n";
        echo "Temperature: " . $holiday['TempRating'] . "\n";
        echo "Activity: " . $holiday['Category'] . "\n";
        echo $holiday['Weight'] . "\n\n";

    }

    function temperatureInt($temperature_string) {
        switch ($temperature_string) {
            case ('cold'):
                return 1;
            case ('mild'):
                return 2;
            case ('hot'):
                return 3;
        }
    }

    function weightHolidays($holidays, $user_want) {
        $to_return = [];
        foreach ($holidays as $holiday) {
            $holiday['Weight'] =  0;

            // Price - 4 max
            // 0 - half more
            // 1 - quarter more
            // 2 - around same
            // 3 - quarter less
            // 4 - half less
            $hol_price = $holiday['PricePerNight'];
            $want_price = $user_want['price'];
            $price_quarter = $want_price / 4;
            $price_half = $want_price / 2;

            if ($hol_price >= $want_price + $price_half) {
                // half more
            } elseif ($hol_price >= $want_price + $price_quarter) {
                // quarter more
                $holiday['Weight'] = 1;
            } elseif ($hol_price < $want_price + $price_quarter && $hol_price >= $want_price - $price_quarter) {
                // around same
                $holiday['Weight'] = 2;
            } elseif ($hol_price < $want_price - $price_quarter && $hol_price >= $want_price - $price_half) {
                // quarter less
                $holiday['Weight'] = 3;
            } elseif ($hol_price < $want_price - $price_half) {
                // half less
                $holiday['Weight'] = 4;
            }


            // Abroad - 2 max
            // 0 - is not what user wants
            // 2 - is what user wants
            $local = $holiday['Country'] == $user_want['abroad']['country'];

            if ($local == $user_want['abroad']['want']) {
                // hotel is local and user wants to be local OR
                // hotel is abroad and user wants to be abroad
                $holiday['Weight'] =  $holiday['Weight'] + 2;
            }

            // Location - 2 max
            // 0 - is not what user wants
            // 2 - is what user wants
            if ($holiday['Location'] == $user_want['location']) {
                $holiday['Weight'] = $holiday['Weight'] + 2;
            }


            // Stars - 2 max
            // 0 - lower than minimum wanted
            // 1 - is minimum wanted
            // 2 - higher than minimum wanted
            $hol_stars = $holiday['StarRating'];
            $want_stars = $user_want['stars'];

            if ($want_stars == 5 && $hol_stars == 5) {
                $holiday['Weight'] = $holiday['Weight'] + 2;
            }

            if ($hol_stars == $want_stars) {
                $holiday['Weight'] = $holiday['Weight'] + 1;
            } elseif ($hol_stars > $want_stars) {
                $holiday['Weight'] = $holiday['Weight'] + 2;
            }

            // Temperature
            // 0 - if opposite of ideal
            // 1 - if mild and ideal or hotel mild
            // 2 - if ideal
            $hol_temp = $this->temperatureInt($holiday['TempRating']);
            $want_temp = $this->temperatureInt($user_want['temperature']['ideal']);

            if ($want_temp == 2) {
                // ideal is mild
                $want_preferred = $this->temperatureInt($user_want['temperature']['prefer']);
                if ($hol_temp == $want_temp) {
                    // hotel is mild
                    $holiday['Weight'] = $holiday['Weight'] + 2;
                } elseif ($hol_temp == $want_preferred) {
                    // hotel is preferred after mild
                    $holiday['Weight'] = $holiday['Weight'] + 1;
                }
            } elseif ($hol_temp == $want_temp) {
                $holiday['Weight'] = $holiday['Weight'] + 2;
            } elseif ($hol_temp == 2) {
                // hotel is mild
                $holiday['Weight'] = $holiday['Weight'] + 1;
            }

            // Activity - 1 max
            // 1 - is what user wants
            if ($holiday['Category'] == $user_want['activity']) {
                $holiday['Weight'] = $holiday['Weight'] + 1;
            }

            $to_return[] = $holiday;
        }
        return $to_return;
    }

    function rankHolidays($holidays) {
        // Rank by weight, then price, then stars
        usort($holidays, function ($hol1, $hol2) {
            if ($hol1['Weight'] == $hol2['Weight']) {
                // weights are the same
                if ($hol1['PricePerNight'] == $hol2['PricePerNight']) {
                    // prices are the same
                    return $hol2['StarRating'] <=> $hol1['StarRating'];
                } else {
                    return $hol1['PricePerNight'] <=> $hol2['PricePerNight'];
                }
            } else {
                return $hol2['Weight'] <=> $hol1['Weight'];
            }
        });
        return $holidays;
    }
}
