<?php

namespace phOMXPlayer;
/**
 * Arguments interface for OMXPlayer shell arguments.
 */
interface DBusArgumentsInterface
{
  /**
   * @param mixed $value Contains the input value.
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\PrintAddress
   */
  public function print_address($value): ShellArguments;

  /**
   * @param mixed $value Contains the input value.
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\PrintPid
   */
  public function print_pid($value): ShellArguments;

  /**
   * @param mixed $value Contains the input value.
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Session
   */
  public function session($value): ShellArguments;

  /**
   * @param mixed $value Contains the input value.
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Fork
   */
  public function fork($value): ShellArguments;

}
