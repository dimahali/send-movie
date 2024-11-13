<?php

function getInitials(string $name): string
{

    $words = explode(' ', $name);

    if (count($words) >= 2) {
        return mb_strtoupper(
            mb_substr($words[0], 0, 1, 'UTF-8') .
            mb_substr(end($words), 0, 1, 'UTF-8'),
            'UTF-8');
    }

    return makeInitialsFromSingleWord($name);

}

function makeInitialsFromSingleWord(string $name): string
{

    preg_match_all('#([A-Z]+)#', $name, $capitals);

    if (count($capitals[1]) >= 2) {
        return mb_substr(implode('', $capitals[1]), 0, 2, 'UTF-8');
    }

    return mb_strtoupper(mb_substr($name, 0, 2, 'UTF-8'), 'UTF-8');

}

function getRatingStars(float $average_rating): string
{

    $rating = "";

    for ($star = 1; $star <= 5; $star++) {

        if ($star <= $average_rating) {

            $rating .= "<svg xmlns='http://www.w3.org/2000/svg'
                             class='w-[18px] h-[18px] fill-current inline'
                             viewBox='0 0 16 16'>
                            <path
                                d='M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z' />
                        </svg>";

        } elseif ($star - $average_rating < 1) {

            $rating .= "<svg xmlns='http://www.w3.org/2000/svg'
                             class='w-4 h-4 fill-current inline'
                             viewBox='0 0 16 16'>
                        <path
                            d='M5.354 5.119 7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.548.548 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.52.52 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.58.58 0 0 1 .085-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.565.565 0 0 1 .162-.505l2.907-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.001 2.223 8 2.226v9.8z' />
                    </svg>";

        } else {

            $rating .= "<svg xmlns='http://www.w3.org/2000/svg'
                             class='w-3.5 h-3.5 fill-current inline'
                             viewBox='0 0 16 16'>
                            <path
                                d='M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z' />
                        </svg>";

        }

    }

    return $rating;

}

if (!function_exists('formatViews')) {
    function formatViews($number)
    {
        if ($number >= 1000000000) {
            return number_format($number / 1000000000, 1) . 'B'; // For billions
        }
        if ($number >= 1000000) {
            return number_format($number / 1000000, 1) . 'M'; // For millions
        }
        if ($number >= 1000) {
            return number_format($number / 1000, 1) . 'k'; // For thousands
        }
        return $number; // For anything less than 1000
    }
}
