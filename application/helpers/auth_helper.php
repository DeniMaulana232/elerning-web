<?php
defined('BASEPATH') or exit('No direct script access allowed');

function cek_login()
{

    $CI = &get_instance();
    $email = $CI->session->email;

    if ($email == NULL) {
        $CI->session->set_flashdata('message', '<div class="alert alert-danger">
        anda harus login </div>');
        redirect('guru/authguru');
    }
}
function cek_siswa()
{

    $CI = &get_instance();
    $username = $CI->session->role_id;

    if ($username != '3') {
        $CI->session->set_flashdata('message', '<div class="alert alert-danger">
        anda harus login </div>');
        redirect('siswa/authuser');
    }
}
function cek_admin()
{

    $CI = &get_instance();
    $email = $CI->session->email;

    if ($email == NULL) {
        $CI->session->set_flashdata('message', '<div class="alert alert-danger">
        anda harus login </div>');
        redirect('auth');
    }
}

function is_user()
{

    $CI = &get_instance();

    $tipeuser = $CI->session->role_id;

    if ($tipeuser == '2') {
        return $tipeuser;
    }

    return null;
}
