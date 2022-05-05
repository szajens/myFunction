<?php

        /**
         * domainFilter() - szajens
         *
         *
         * @param mixed $allowed_domain - allowed domain format ['example.net','subdomain.example.com'] , don't use http://
         * @param mixed $domain_to_check - input domain to check e.g. www.www.www.www.a1.g.h.r.r.e.e.e.e.e.e.d.subdomain.example.com
         *
         * @return array associates
         *
         *               if not found:
         *    ['matches'] type (int) == 1
         *    [0] == empty array()
         *
         *               if checked:
         *
         *    ['matches'] type (int) == 1
         *    [0][0] => www. - prefix
         *    [0][1] => a1.g.h.r.r.e.e.e.e.e.e.d - subdomain or null if not check
         *    [0][2] => subdomain.example.com - domain   <br>
         *
         *
         *
         */

        function domainFilter(array $allowed_domain, string $domain_to_check):array {

            $result = [];//only for IDE (warning undefined variable)

            $allowed_domain = implode('|', $allowed_domain);

            $result['matches'] = preg_match('/^(?:(w{3})\.)*(?:((?:[a-z0-9\-\_]+\.)*[a-z0-9\-\_]+)\.)*('.$allowed_domain.')$/', $domain_to_check, $result[0]);

            //remove first element from array, but first array return input param $allowed_domain
            array_shift($result[0]);

            return $result;
        }



        d(
            domainFilter(['crazy.sub.domain.com', 'ci.loc'], 'www.usersubdomain.crazy.sub.domain.com')
        );

        d(
            domainFilter(['crazy.sub.domain.com', 'ci.loc'], 'aaa.bbb.usersubdomain.crazy.sub.domain.com')
        );